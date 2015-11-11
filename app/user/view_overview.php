<?php
	require_once 'init.php';
?>
<div class="app-pane">
	<div class="app-pane-header">
		<div class="btn-group">
			<a href="javascript: void(0);" class="btn btn-primary" onclick="boss.bookmark.set('tab', '/app/user/view_overview/');boss.ajax.load('/app/user/view_overview/', '#app_conteiner');">Visão Geral</a>
			<a href="javascript: void(0);" class="btn" onclick="boss.bookmark.set('tab', '/app/project/view_project/');boss.ajax.load('/app/project/view_project/', '#app_conteiner');">Projetos</a>
		</div>
	</div>
	<div class="app-pane-body" style="background-color:#F9F9F9;">
		<div class="col-12">
			<div class="card">
				<div class="card-content">
					<img src="https://upload.wikimedia.org/wikipedia/en/6/6b/Bar_graph.png" width="200px">
					<img src="https://upload.wikimedia.org/wikipedia/en/6/6b/Bar_graph.png" width="200px">
					<img src="https://upload.wikimedia.org/wikipedia/en/6/6b/Bar_graph.png" width="200px">
					<img src="https://upload.wikimedia.org/wikipedia/en/6/6b/Bar_graph.png" width="200px" class="mobile-hidden">
				</div>
				<div class="card-action">
					<h3 class="font-open-sans">Estatística</h3>
				</div>
			</div>
		</div>
	</div>
</div>
