<div id="support_default" class="modal-popup">
	<div class="popup">
		<button id="close_default" class="close">X</button>
		<div class="container">
			<h4 class="h4 font-open-sans  title-header">Suporte <span class="font-lato text-black bold">Padrão</span></h4>
			<p class="font-lato text-dark text-justify paragraph">Suporte para quem possui dúvidas relacionadas a utilizção das ferramentas existentes no sistema. Ex: O que essa ferramenta faz?</p>
			<p class="font-lato text-dark text-justify paragraph bleed-bottom">Após a contratação do suporte, dentro de 24 horas, a equipe técnica retorna com o fornecimento um documento explicativo das ferramentas do sistema.</p>
		</div>
	</div>
</div>
<div id="support_premium" class="modal-popup">
	<div class="popup">
		<button id="close_premium" class="close">X</button>
		<div class="container">
			<h4 class="h4 font-open-sans  title-header">Suporte <span class="font-lato text-danger bold">Premium</span></h4>
			<p class="font-lato text-dark text-justify paragraph">Suporte para quem possui dúvidas relacionadas a utilizção das ferramentas existentes no sistema e/ou também queira contatar um de nossos técnicos por meio de mensagens eletrônicas para sanar alguma dúvida mais complexa, mas que não tenha tanta urgência.</p>
			<p class="font-lato text-dark text-justify paragraph bleed-bottom">Após a contratação do suporte e o envio da mensagem aos técnicos, dentro de 20 horas, o cliente será contatado e auxiliado com recursos que envolvem, além do envio de email, o acesso à doumentação das ferramentas do sistema.</p>
		</div>
	</div>
</div>
<div id="support_business" class="modal-popup">
	<div class="popup">
		<button id="close_business" class="close">X</button>
		<div class="container">
			<h4 class="h4 font-open-sans  title-header">Suporte <span class="font-lato text-success bold">Empresarial</span></h4>	
			<p class="font-lato text-dark text-justify paragraph">Suporte para clientes que possuem dúvidas relacionadas a utilizção do sistema e precisam de uma resposta mais rápida.</p>
			<p class="font-lato text-dark text-justify paragraph bleed-bottom">Após a contratação do suporte o cliente possui direito de contatar a equipe técnica por meio telefônico e envio de emails, com retorno de até 12 horas, além disso terá acesso à documentação dentro do  mesmo prazo de retorno da mensagem eletrônica.</p>
		</div>
	</div>
</div>
<div class="col-12">
	<div class="col-9 pull-left">
		<div class="container">
			<div class="col-12"><h2 class="font-lato text-primary">Planos de<span class="font-open-sans bold"> Suporte</span></h2>
				<p class="font-lato text-dark text-justify paragraph">Suporte oferecido aos usuários com técnicos preparados à sua disposição, para solucionar problemas e sanar dúvidas relacionadas á utilização das ferramentas do sistema.</p>
			</div>
			<hr>
			<div class="col-12 bleed-bottom">
				<h3 class="font-lato text-primary text-center"><span class="font-open-sans">Conheça os tipos de</span> Suporte :</h3>
				<table class="table table-striped table-border table-responsive">
					<thead>
						<th class="text-center"><a id="link_default" class="h4 font-open-sans text-center text-black bold">Padrão</a></th>
						<th class="text-center"><a id="link_premium" class="h4 font-lato text-danger bold">Premium</a></th>
						<th class="text-center"><a id="link_business" class="h4 font-lato text-success bold">Empresarial</a></th>
					</thead>
					<tbody>
						<tr>
							<td class="text-center text-dark">
								Acesso Documentação
							</td>
							<td class="text-center text-dark">
								Acesso Documentação
							</td>
							<td class="text-center text-dark">
								Acesso Documentação
							</td>
						</tr>
						<tr>
							<td class="text-center text-dark">
								Resposta em até 24h 
							</td>
							<td class="text-center text-dark">
								Resposta em até 20h
							</td>
							<td class="text-center text-dark">
								Resposta em até  12h
							</td>
						</tr>
						<tr>
							<td class="text-center text-dark">
								-
							</td>
							<td class="text-center text-dark">
								Email
							</td>
							<td class="text-center text-dark">
								Disponibilidade
							</td>
						</tr>
						<tr>
							<td class="text-center text-dark">
								-
							</td>
							<td class="text-center text-dark">
								-
							</td>
							<td class="text-center text-dark">
								Telefone
							</td>
						</tr>
						<tr>
							<td class="text-center text-dark">
								-
							</td>
							<td class="text-center text-dark">
								-
							</td>
							<td class="text-center text-dark">
								Email
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-3 pull-right">
		<div class="container">
			<ul class="list-group">
				<li class="list-group-title bg-azure-light text-white">
					Noticias
				</li>
				<li class="list-group-item list-group-hover">
					<span class="badge">1</span>
					Programação
				</li>
				<li class="list-group-item list-group-hover">
					<span class="badge">1</span>
					Design
				</li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#link_default').on('click', function(event) {
			event.preventDefault();
			$('#support_default').addClass('modal-popup-action');
		});
		$('#close_default').on('click', function(event) {
			event.preventDefault();
			$('#support_default').removeClass('modal-popup-action');
		});
		
		$('#link_premium').on('click', function(event) {
			event.preventDefault();
			$('#support_premium').addClass('modal-popup-action');
		});
		$('#close_premium').on('click', function(event) {
			event.preventDefault();
			$('#support_premium').removeClass('modal-popup-action');
		});

		$('#link_business').on('click', function(event) {
			event.preventDefault();
			$('#support_business').addClass('modal-popup-action');
		});
		$('#close_business').on('click', function(event) {
			event.preventDefault();
			$('#support_business').removeClass('modal-popup-action');
		});
	});
</script>