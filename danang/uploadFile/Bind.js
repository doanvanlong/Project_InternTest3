(function () {
  const booleanAttributes = ["allowfullscreen", "allowpaymentrequest", "autofocus", "autoplay", "checked", "controls", "default", "disabled", "formnovalidate", "hidden", "ismap", "itemscope", "loop", "multiple", "muted", "novalidate", "open", "playsinline", "readonly", "required", "reversed", "selected", "truespeed"],
    regexp = createRegexp(),
    mountedHandlers = [],
    mutationObserver = new MutationObserver(checkElementsForMount);
  mutationObserver.observe(document, {
    childList: true,
    subtree: true
  });
  function checkElementsForMount(mutations) {
    for (let i in mutations) {
      let mut = mutations[i];
      for (let k in mut.addedNodes) {
        let node = mut.addedNodes[k];
        for (let x in mountedHandlers) {
          let item = mountedHandlers[x];
          if (item && item.elem == node) {
            item.handler();
            delete mountedHandlers[x];
          }
        }
      }
    }
  }
  const Bind = function (props) {
    const self = {},
      scheme = {};
    let elem = null,
      watchersEnabled = true;
    init();
    return self;
    function init() {
      elem = props.elem || elemFromTemplate(props.template) || null;
      initElem();
      defineProperties();
      grabInstructions(elem);
      updateElem(true);
      Object.defineProperty(self, "_compute", {
        writable: false,
        enumerable: false,
        configurable: false,
        value: function (key) {
          const fn = props.computed[key]
          if (!fn) {
            return;
          }
          self[key] = fn.call(self);
          handleChanges(key);
          return self[key];
        }
      });
      if (props.mounted) {
        let mounted = props.mounted;
        if (document.body.contains(elem)) {
          mounted.call(self);
        } else {
          setMountedWatcher(elem, mounted.bind(self));
        }
      }
    }
    function initElem() {
      Object.defineProperty(self, "elem", {
        get: function () {
          return elem;
        },
        set: function () {
          console.error("The \"elem\" variable is used by the script.");
        }
      });
    }
    function updateElem(disableWatchers) {
      if (disableWatchers) {
        watchersEnabled = false;
      }
      for (let key in props.data) {
        handleChanges(key, props.data[key]);
      }
      if (disableWatchers) {
        watchersEnabled = true;
      }
    }
    function grabInstructions(node) {
      node.childNodes && Array.prototype.forEach.call(node.childNodes, grabInstructions);
      let attrs = node.attributes;
      if (attrs && attrs.length) {
        attrs = Array.prototype.slice.call(node.attributes);
        for (var i = 0, l = attrs.length; i < l; i++) {
          if ([":", "@"].indexOf(attrs[i].name[0]) == -1) {
            continue;
          }
          if (":" == attrs[i].name[0]) {
            handleAttribute(node, attrs[i].name.slice(1), attrs[i].value);
          } else if ("@" == attrs[i].name[0]) {
            let parts = attrs[i].name.split(".");
            handleEventAttribute(node, parts.splice(0, 1)[0].slice(1), attrs[i].value, parts);
          }
          node.removeAttribute(attrs[i].name);
        }
      } else if (node.nodeType == 3 && matchTextNode(node.textContent).length) {
        handleText(node, node.textContent);
      }
    }
    function handleAttribute(node, attr, value) {
      const dependency = getVariables(value);
      if (node.getAttribute(attr)) {
        let current = node.getAttribute(attr).split(" ").map(function (val) { return "'" + val + "'" });
        value = "[" + current.join(",") + "," + (value[0] == "[" ? value.slice(1) : value + "]");
      }
      if (!dependency.length) {
        let instruct = {};
        instruct[attr] = [{
          node: node,
          value: value
        }]
        updateAttributesValue(instruct);
        return;
      }
      for (let index in dependency) {
        let variable = dependency[index];
        if (!scheme[variable]) {
          scheme[variable] = {};
        }
        if (!scheme[variable]["attribute"]) {
          scheme[variable]["attribute"] = {};
        }
        if (!scheme[variable]["attribute"][attr]) {
          scheme[variable]["attribute"][attr] = [];
        }
        scheme[variable]["attribute"][attr].push({
          node: node,
          value: value
        });
      }
    }
    function handleEventAttribute(node, attr, value, mods) {
      mods = mods || [];
      node.addEventListener(attr, function (event) {
        for (let index in mods) {
          let mod = mods[index];
          switch (mod) {
            case ("prevent"): {
              event.stopPropagation();
              event.preventDefault();
              break;
            };
            case ("shift"): {
              if (!event.shiftKey) {
                return;
              }
              break;
            }
            case ("enter"): {
              if (event.keyCode != 13) {
                return;
              }
              break;
            }
            case ("space"): {
              if (event.keyCode != 32) {
                return;
              }
              break;
            }
          }
        }
        execExpression(value, {
          event: event
        });
      });
    }
    function handleText(node, text) {
      const matches = matchTextNode(text, true, true);
      let hasScopeVariable = matches.some(function (match) { return match.match(regexp.declaration) });
      if (!hasScopeVariable) {
        replaceTextNode(node, execTextNode(text));
        return;
      }
      setTextHandler(node, text);
    }
    function matchTextNode(text, slice, trim) {
      let matches = text.match(regexp.brackets) || [];
      if (slice) {
        if (trim) {
          matches = matches.map(function (match) { return match.slice(2, -2).trim() });
        } else {
          matches = matches.map(function (match) { return match.slice(2, -2) });
        }
      }
      return matches;
    }
    function replaceTextNode(node, value) {
      node.textContent = value;
    }
    function execTextNode(text) {
      const matches = matchTextNode(text, true);
      for (let index in matches) {
        let match = matches[index];
        text = text.replace("{{" + match + "}}", execExpression(match));
      }
      return text;
    }
    function execExpression(expression, args) {
      let keys = null,
        values = null,
        func = null,
        result = null;
      if (args) {
        keys = Object.keys(args);
        values = keys.slice().map(function (key) {
          return args[key]
        });
      }
      if (!expression.trim()) {
        return expression;
      }
      if (keys && keys.length) {
        let fn = "return function(" + keys.join(",") + "){";
        fn += "return " + expression;
        fn += "}";
        func = new Function(fn).call(self);
        result = func.apply(self, values);
      } else {
        func = new Function("return " + expression);
        result = func.call(self);
      }
      return result;
    }
    function elemFromTemplate(template) {
      if (!template) {
        return;
      }
      let div = document.createElement("div");
      div.innerHTML = template;
      return div.firstElementChild;
    }
    function defineProperty(key, type) {
      const descriptor = {
        get: function () { return props[type][key] }
      };
      if ("data" == type && !Array.isArray(props[type][key])) {
        descriptor.set = function (value) {
          let oldValue = props[type][key];
          props[type][key] = value;
          oldValue != value && handleChanges(key, value, oldValue);
        }
        descriptor.enumerable = true;
      }
      Object.defineProperty(self, key, descriptor);
      if ("data" == type && Array.isArray(props[type][key])) {
        const methods = ["push", "pop", "splice", "shift", "unshift"]; //slice
        for (let index in methods) {
          let method = methods[index];
          Object.defineProperty(self[key], method, {
            configurable: false,
            enumerable: false,
            writable: false,
            value: function () {
              const result = Array.prototype[method].apply(props.data[key], arguments);
              handleChanges(key, props.data[key]);
              return result;
            }
          });
        }
      }
    }
    function handleChanges(variable, value, oldValue) {
      for (let type in scheme[variable]) {
        if ("computed" == type) {
          for (let key in scheme[variable][type]) {
            execComputed(scheme[variable][type][key], key, value, oldValue)
          }
        } else if ("watch" == type) {
          watchersEnabled && scheme[variable][type](value, oldValue);
        } else if ("text" == type) {
          for (let index in scheme[variable][type]) {
            let item = scheme[variable][type][index];
            replaceTextNode(item.node, execTextNode(item.value));
          }
        } else if ("attribute" == type) {
          updateAttributesValue(scheme[variable][type]);
        }
      }
    }
    function updateInnerText(node, value) {
      const exec = execExpression(value);
      node.innerText = exec;

    }
    function updateAttributesValue(instruct) {
      for (let attr in instruct) {
        for (let index in instruct[attr]) {
          let item = instruct[attr][index];
          if ("style" == attr) {
            updateStyleAttribute(item.node, item.value);
          } else if ("class" == attr) {
            updateClassAttribute(item.node, item.value);
          } else if ("bind-inner" == attr) {
            updateInnerText(item.node, item.value);
          } else if (booleanAttributes.indexOf(attr) != -1) {
            updateBooleanAttribute(item.node, attr, item.value);
          } else {
            updateDefaultAttribute(item.node, attr, item.value);
          }
        }
      }
    }
    function updateStyleAttribute(node, value) {
      const exec = execExpression(value);
      let result = [];
      for (let prop in exec) {
        if (exec[prop] === false || exec[prop] === null || exec[prop] === undefined) {
          continue;
        }
        result.push(prop + ":" + exec[prop]);
      }
      if (result.length) {
        node.setAttribute("style", result.join(";"));
      } else {
        node.removeAttribute("style");
      }
    }
    function updateClassAttribute(node, value) {
      let exec = execExpression(value),
        add = [],
        remove = [];
      exec = Array.isArray(exec) ? exec : [exec];
      for (let index in exec) {
        let prop = exec[index];
        if (typeof prop == "string") {
          add.push(prop);
          continue;
        }
        for (let className in prop) {
          if (!prop[className]) {
            remove.push(className);
            continue;
          }
          add.push(className);
        }
      }
      for (let index in add) {
        node.classList.add(add[index]);
      }
      for (let index in remove) {
        node.classList.remove(remove[index]);
      }
    }
    function updateBooleanAttribute(node, attr, value) {
      let exec = execExpression(value);
      if (exec) {
        node.setAttribute(attr, "");
      } else {
        node.removeAttribute(attr);
      }
    }
    function updateDefaultAttribute(node, attr, value) {
      let exec = execExpression(value);
      node.setAttribute(attr, exec);
    }
    function execComputed(fn, key, value, oldValue) {
      self[key] = fn(value, oldValue);
      value !== oldValue && handleChanges(key, value, oldValue);
    }
    function defineProperties() {
      const types = {
        "data": defineProperty,
        "methods": defineProperty,
        "computed": setHandler,
        "watch": setHandler
      }
      for (let type in types) {
        for (let key in props[type]) {
          types[type](key, type);
        }
      }
    }
    function setTextHandler(node, value) {
      let dependency = getVariables(value);
      for (let index in dependency) {
        let variable = dependency[index];
        if (!scheme[variable]) {
          scheme[variable] = {};
        }
        if (!scheme[variable]["text"]) {
          scheme[variable]["text"] = [];
        }
        let length = scheme[variable]["text"].push({
          node: node,
          value: value
        });
      }
    };
    function setHandler(key, type) {
      let dependency;
      if ("watch" == type) {
        dependency = [key];
      } else if ("computed" == type) {
        dependency = getVariables(props[type][key]);
      }
      for (let index in dependency) {
        let variable = dependency[index];
        if (!scheme[variable]) {
          scheme[variable] = {};
        }
        if ("watch" == type) {
          scheme[variable][type] = props[type][key].bind(self);
        } else if (!scheme[variable][type]) {
          scheme[variable][type] = {};
        }
        if ("computed" == type) {
          scheme[variable][type][key] = props[type][key].bind(self);
          execComputed(scheme[variable][type][key], key);
        }
      }
    }
    function getVariables(func) {
      return (func.toString().match(regexp.declaration) || [])
        .map(function (match) { return match.replace("this.", "") });
    }
  }
  function setMountedWatcher(elem, handler) {
    mountedHandlers.push({
      elem: elem,
      handler: handler
    })
  }
  function createRegexp() {
    let exclude = "!%&*()-+={}[]:;\'\"\`,./\\?|\s";
    exclude = exclude.split("").map(function (s) { return "\\" + s }).join();

    return {
      brackets: new RegExp("{{.*?}}", "gm"),
      declaration: new RegExp("this.[^" + exclude + "]+", "gm")
    }
  }
  window.Bind = Bind;
})();