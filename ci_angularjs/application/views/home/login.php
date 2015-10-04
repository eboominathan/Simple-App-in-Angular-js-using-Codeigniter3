<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AngularJS Posting Login Form</title>
	


	<style type="text/css">
		.login-form {
			max-width: 300px;
			margin: 0 auto;
		}
		#inputUsername {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		#inputPassword {
			border-top-left-radius: 0;
  			border-top-right-radius: 0;
		}
	</style>
  </head>
  <body ng-app="postExample" ng-controller="PostController as postCtrl" background="<?php echo base_url();?>assets/imgs/ci.jpg">
    <div class="container">
      <form class="login-form" ng-submit="postCtrl.postForm()">

        <h2>Please sign in</h2>

        <div class="alert alert-danger" role="alert" ng-show="errorMsg">{{errorMsg}}</div>



        <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
        <div class="alert alert-danger alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        	<?php print_r($msg);?>
        </div>
        <?php }?>



                       
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus ng-model="postCtrl.inputData.username">
        <br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required ng-model="postCtrl.inputData.password">
		<br>
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		
      </form>
    </div> 
	<script>
	angular.module('postExample', [])
	.controller('PostController', ['$scope', '$http', function($scope, $http) {
		
		this.postForm = function() {
		
			var encodedString = 'username=' +
				encodeURIComponent(this.inputData.username) +
				'&password=' +
				encodeURIComponent(this.inputData.password);
				
			$http({
				method: 'POST',
				url: '<?php echo base_url();?>home/check_login',
				data: encodedString,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(data, status, headers, config) {
				console.log(data);


				 if ( data.trim() ==true) {

					window.location.href = '<?php echo base_url();?>hello/dashboard';
				}
				 else {
					$scope.errorMsg = "Wrong Username or password!";
				}
			})
			.error(function(data, status, headers, config) {
				$scope.errorMsg = 'Unable to submit form';
			})
		}
		
	}]);
	</script>
  </body>
</html>
