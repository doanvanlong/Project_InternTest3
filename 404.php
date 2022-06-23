<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>404</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="/font-awesome-4.6.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&amp;subset=vietnamese" rel="stylesheet">
	<style>
#error-page{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100%; 
}
.error-code{
  font-size: 180px;
  line-height: 180px;
  color: #f5acac;
  text-shadow: 0 1px #944040;
  float: right;
}
.error-message{
  font-size: 24px;
  line-height: 34px;
  text-transform: uppercase;
  color: #999;
  text-shadow: 0 1px #fff;
  margin-right: 10px;
  text-align: center;
  margin-top: 30px;
}
#error-img {
	width: 100%;
	margin: 0 auto;
}
#error-img img{
  width: 100%;
}
	</style>
</head>
<body style="background: #f5f5f5">
	<div class="container">
		<div  id="error-page">
			<div>
				<div id="error-img">
					<img src="/images/404.svg" alt="404" >
				</div>
				<p class="error-message">
					Không tìm thấy trang<br />
					Go Back <a href="/index.html" title="Home"><i class="fa fa-home"></i> Home</a>
				</p>
			</div>
		</div>
	</div>
</body>
</html>