	<style type="text/css">		.color{			height:60px;			width:100px;			border:3px solid #000;			-web-border-radius:5px;			border-radius:5px;			line-height:30px;		}		.color-grey{background:#BFBFBF;}		.color-blue{background:#004CD8;}		.color-green{background:#14C40C;}		.color-orange{background:#FF5F27;}	</style>		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dropdown.js"></script>	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dropdown.css" />		<input type="button" value="1" data-dropdown="#dropdown-1" class="color-grey color"/>	<input type="button" value="2" data-dropdown="#dropdown-2" class="color-blue color" />	<input type="button" value="3" data-dropdown="#dropdown-3" class="color-green color" />	<input type="button" value="4" data-dropdown="#dropdown-4" class="color-orange color" />		<!-- Remember to put your dropdown menus before your ending BODY tag -->	<div id="dropdown-1" class="dropdown dropdown-tip">		<ul class="dropdown-menu">			<li><a href="#1">R</a></li>			<li><a href="#2">Item 2</a></li>			<li><a href="#3">Item 3</a></li>			<li class="dropdown-divider"></li>			<li><a href="#4">Item 4</a></li>			<li><a href="#5">Item 5</a></li>			<li><a href="#5">Item 6</a></li>		</ul>	</div>		<div id="dropdown-2" class="dropdown dropdown-tip">		<ul class="dropdown-menu">			<li><a href="#1">Item 1</a></li>		</ul>	</div>		<div id="dropdown-3" class="dropdown dropdown-tip">		<ul class="dropdown-menu">			<li><a href="#1">Item 1</a></li>		</ul>	</div>		<div id="dropdown-4" class="dropdown dropdown-tip">		<ul class="dropdown-menu">			<li><a href="#1">Item 1</a></li>		</ul>	</div>