<div class="app-pane">
	<div class="app-pane-header">
		<div class="col-6 pull-left">
			<div id="btn_group_options" class="btn-group">
				<a class="btn btn-primary" onclick="boss.ajax.load('/app/project/profile/', '#app_conteiner');">Projeto</a>
				<a class="btn" onclick="boss.ajax.load('/app/task/taskview/', '#app_conteiner');">Minhas tarefas</a>
				<a class="btn" onclick="boss.ajax.load('/app/team/teamview/', '#app_conteiner');">Equipe</a>
			</div>
		</div>
		<div class="col-6 pull-left text-right">
			<div id="btn_group_icons" class="btn-group">
				<a class="btn btn-primary"><img src="/static/img/icons/graphic.png" width="32px"></a>
				<a class="btn"><img src="/static/img/icons/share.png" width="16px"></a>
				<a class="btn"><img src="/static/img/icons/tools.png" width="20px"></a>
			</div>
		</div>
	</div>
	<div class="app-pane-body" style="background-color:#F9F9F9;">
		
	</div>
</div>
<script type="text/javascript">
	if(boss.isMobile()){
		$('#btn_group_options').css({'width': '100%!important'});
		$('#btn_group_icons').addClass('mobile-hidden');
	}
</script>