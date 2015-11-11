<?php
	require_once('head.php');

	$base = dirname(__FILE__).'\\..\\..\\';
	$app = null;
	$img = null;

	if(!empty($_GET['p'])) {
		$app = $_GET['p'];
		$img = $base."static\\img\\things\\".$app.".png";
	}
?>
<iframe src="" name="compiler" width="0" height="0" style="display: none;"></iframe>
<div class="jumbotron jumbotron-big bg-azure-light bg-dots">
	<div id="navbar" class="navbar fixed-top font-white">
		<div class="bleed">
			<div class="brand italic">
				<img id="logo" src="/static/img/logo/falcon.png" width="60px" onclick="location.href='/'">
			</div>
			<button class="navbar-toggle" onclick="jAgil.toggleClass('nav_toggle','nav-toggle');">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div id="nav_toggle" class="nav pull-right">
				<ul>
					<li class="link" onclick="location.href='/'">Home</li>
					<li class="link" onclick="location.href='/tour/'">Tour</li>
					<li class="link" onclick="location.href='/support/'">Suporte</li>
					<li class="link"  onclick="location.href='/blog/program/'">Blog</li>
					<li class="link" onclick="location.href='/about/'">Sobre</li>
					<li class="link" onclick="location.href='/contact/'">Contato</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container text-white">
		<div class="col-6 pull-left">
			<h1 class="font-lato"><span class="font-open-sans">Tec</span>Falcon</h1>			
		</div>
		<div class="col-6 pull-left">
			<?php if (!empty($app) && file_exists($img)): ?>

				<img src="/static/img/things/<?php echo $app;?>.png" class="pull-right mobile-hidden" width="220px"/>

			<?php endif;?>
		</div>
	</div>
</div>
<div class="app_conteiner"></div>
<script type="text/javascript">
	$(function(){
		boss.ajax.load('/app/<?php echo $app;?>/', '.app_conteiner');
	})
</script>
<?php
	require_once('footer.php');
?>