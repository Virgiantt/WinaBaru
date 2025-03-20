<style>
	@import url("https://fonts.googleapis.com/css?family=Roboto");
	@-webkit-keyframes come-in {
		0% {
			-webkit-transform: translatey(100px);
			transform: translatey(100px);
			opacity: 0;
		}
		30% {
			-webkit-transform: translateX(-50px) scale(0.4);
			transform: translateX(-50px) scale(0.4);
		}
		70% {
			-webkit-transform: translateX(0px) scale(1.2);
			transform: translateX(0px) scale(1.2);
		}
		100% {
			-webkit-transform: translatey(0px) scale(1);
			transform: translatey(0px) scale(1);
			opacity: 1;
		}
	}
	@keyframes come-in {
		0% {
			-webkit-transform: translatey(100px);
			transform: translatey(100px);
			opacity: 0;
		}
		30% {
			-webkit-transform: translateX(-50px) scale(0.4);
			transform: translateX(-50px) scale(0.4);
		}
		70% {
			-webkit-transform: translateX(0px) scale(1.2);
			transform: translateX(0px) scale(1.2);
		}
		100% {
			-webkit-transform: translatey(0px) scale(1);
			transform: translatey(0px) scale(1);
			opacity: 1;
		}
	}

	.floating-container {
		position: fixed;
		width: 100px;
		height: 100px;
		bottom: 0;
		right: 0;
		margin: 25px 25px;
	}
	.floating-container:hover {
		height: 310px;
	}
	.floating-container:hover .floating-button {
		box-shadow: 0 10px 25px rgba(152, 0, 0, 0.6);
		-webkit-transform: translatey(5px);
		transform: translatey(5px);
		-webkit-transition: all 0.3s;
		transition: all 0.3s;
	}
	.floating-container:hover .element-container .float-element:nth-child(1) {
		-webkit-animation: come-in 0.4s forwards 0.2s;
		animation: come-in 0.4s forwards 0.2s;
	}
	.floating-container:hover .element-container .float-element:nth-child(2) {
		-webkit-animation: come-in 0.4s forwards 0.4s;
		animation: come-in 0.4s forwards 0.4s;
	}
	.floating-container:hover .element-container .float-element:nth-child(3) {
		-webkit-animation: come-in 0.4s forwards 0.6s;
		animation: come-in 0.4s forwards 0.6s;
	}
	.floating-container .floating-button {
		position: absolute;
		width: 65px;
		height: 65px;
		background: #cc0000;
		bottom: 0;
		border-radius: 50%;
		left: 0;
		right: 0;
		margin: auto;
		color: white;
		line-height: 65px;
		text-align: center;
		font-size: 23px;
		z-index: 100;
		box-shadow: 0 10px 25px -5px rgba(152, 0, 0, 0.6);
		cursor: pointer;
		-webkit-transition: all 0.3s;
		transition: all 0.3s;
	}
	.floating-container .float-element {
		position: relative;
		display: block;
		border-radius: 50%;
		width: 50px;
		height: 50px;
		margin: 10px auto;
		color: white;
		font-weight: 500;
		text-align: center;
		line-height: 50px;
		z-index: 0;
		opacity: 0;
		-webkit-transform: translateY(100px);
		transform: translateY(100px);
	}
	.floating-container .float-element .bg-color1 {
		background: #4CAF50;
		box-shadow: 0 20px 20px -10px rgba(76, 175, 80, 0.5);
	}
	.floating-container .float-element .material-icons {
		vertical-align: middle;
		font-size: 16px;
	}
	.floating-container .float-element:nth-child(1) {
		background: #38761d;
		box-shadow: 0 20px 20px -10px rgba(0, 102, 6, 0.6);
	}
	.floating-container .float-element:nth-child(2) {
		background: #4CAF50;
		box-shadow: 0 20px 20px -10px rgba(76, 175, 80, 0.5);
	}
	.floating-container .float-element:nth-child(3) {
		background: #FF9800;
		box-shadow: 0 20px 20px -10px rgba(255, 152, 0, 0.5);
	}
</style>
<main class="container-fluid mt-3">
	<div class="row">
		<?php
		foreach ($main_page as $dt) : ?>
			<div class="col-lg-2 col-md-3 col-sm-12">
				<a href="<?=base_url($dt->url_main_page);?>" style="text-decoration: none;">
					<div class="card">
						<img src="<?=base_url('assets/img/images/');?><?=$dt->icon_main_page;?>" class="card-img-top" alt="..." style="padding: 20px 20px 20px 20px;">
						<div class="card-body">
							<center><h5 class="card-title"><?=$dt->nama_main_page;?></h5></center>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</main>

<div class="floating-container">
	<div class="floating-button">+</div>
	<div class="element-container">
		<a href="<?=base_url('');?>"><span class="float-element tooltip-left"><i class="fa-solid fa-file-arrow-down"></i></span></a>
		<a href="<?=base_url('');?>"><span class="float-element"><i class="fa-solid fa-comments"></i></span></a>
		<a href="<?=base_url('');?>"><span class="float-element"><i class="fa-regular fa-bell"></i></span></a>
		<a href="<?=base_url('');?>"><span class="float-element	"><i class="fa-regular fa-envelope"></i></span></a>
	</div>
</div>
