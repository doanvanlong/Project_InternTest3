<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="REFRESH" content="4; url=<?=$page_transfer?>">
<title>:: Website Administration ::</title>

<style type="text/css">
<style type="text/css">
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: Arial;
  color: #404040;
  background: #343137;
  margin: 0;
}
.container {
  width: 100%;
  min-height: 100vh;
}
.container .notif {
  margin: 0px;
  max-width: 500px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
}
.notif {
  position: relative;
  padding: 40px 50px;
  min-width: 500px;
  line-height: 22px;
  background: white;
  border-radius: 2px;
  overflow: auto;
}
.notif {
  color: #666;
  text-align:center;
}
.notif-title {
  margin: 0 0 5px;
  font-size: 14px;
  font-weight: bold;
  color: #333;

}
.h3{
  margin-bottom: 20px;
}
.mybtn {
  border: none;
  padding: 12px 30px;
  transition: all 0.5s ease;
  text-align: center;
  border-radius: 4px;
  line-height: 1;
  display: inline-block;
}

.mybtn:hover, .mybtn:focus {
  border: 0 !important;
  outline: 0 !important;
}
.mybtn.btn-do {
  background-color: #3085D6;
  color: #fff;
  text-decoration: none;
}

.mybtn.btn-do:hover {
  background-color: #1F5C9A;
  color: #fff;
  transition: all 0.5s ease;
}
@media only screen and (max-width:500px) {
  .container .notif {
    max-width: calc(100% - 30px);
    min-width: calc(100% - 30px);
    left: 15px;
    right: 15px;
    transform: translate(0,-50%);
  }
  .notif {
    position: relative;
    padding: 30px 15px;
    min-width: 500px;
    line-height: 22px;
    background: white;
    border-radius: 2px;
    overflow: auto;
  }
}
</style>
</style>
</head>

<body>
<div class="container">

 <section class="notif">
  <p class="h3"><?=$showtext?></p>
   <p class="text-center"><a href="<?=$page_transfer?>" class="mybtn btn-do">OK </a></p>
 </section>
 </div>
</body>
</html>