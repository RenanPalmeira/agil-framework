<?php 
	require_once 'init.php';
?>
<style>
* {
	margin: 0px;
}
</style>
<div style="margin-top: 100px;"></div>
<canvas id="mycanvas" height="400px" width="800px" style="border:0px solid #000;"></canvas>
<script type="text/javascript" src="/static/js/graphjs.js"></script>
<script type="text/javascript">
	var g = new GraphJs('mycanvas');
	
	c1 = g.node({
		label: 'C1',
		x: 150,
		y: 50,
		color: "deepskyblue"
	});
	c2 = g.node({
		label: 'friend2',
		x: 450,
		y: 150,
		color: "green"
	});
	c3 = g.node({
		label: 'friend3',
		x: 150,
		y: 250,
		color: "blue"
	});
	g.relationship(c1, c2);
	g.relationship(c1, c3);

	
	g.eventing('mousemove', c1, function(){
		void(0);
	});

	g.render();
</script>