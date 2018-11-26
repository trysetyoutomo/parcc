<style type="text/css">
	/*.option-pindah,.option-gabung{
		display: none;
	}*/
	
	#login-waiter{
		padding: 10px;
		font-size: 20px;
	}
	#login-waiter option {
		padding: 10px 10px 0px 10px;
		font-size: 20px;
	}

	.nama_menu{
		font-size: 10px;
	}
	.hapus{
		cursor: pointer;
	}
	.spoile{
		cursor: pointer;
	}
	.btn{
		margin: 5px;
		background: black;
		border:none;
		padding: 5px;
		color: white
	}
	body{
		background-size: cover;	
		padding: 0px!important;
		margin: 0px!important;
		background-image:url('images/waiter.PNG');
	}
	/*#items tbody{
		height: 600px;
		overflow: scroll;

	}*/
	#full{
		width: 100vw;
		margin: 0px!important;
		height: 100vh;
		position: fixed;
		top:0px;
		z-index: 998;
		background-color: white;
		display: none;
		opacity: 0.85;

	}
	#list-meja select{
		width: 90%;
		margin-top:50px;
	}
	#list-meja option{
		padding: 10px;
	}
	#list-meja{
		display: none;
		border-radius:20px;
		width: 300px;
		height: 200px;
		background: red;
		position: fixed;
		top: 0px;bottom: 0px;left:0px;right: 0px;
		margin: auto;
		z-index: 999;

	}
	.area-permintaan{
		width: 100%;
	}
	.blink_me {
		/*background: black!important;*/
		-webkit-animation-name: blinker;
		-webkit-animation-duration: 1s;
		-webkit-animation-timing-function: linear;
		-webkit-animation-iteration-count: infinite;

		-moz-animation-name: blinker;
		-moz-animation-duration: 1s;
		-moz-animation-timing-function: linear;
		-moz-animation-iteration-count: infinite;

		animation-name: blinker;
		animation-duration: 1s;
		animation-timing-function: linear;
		animation-iteration-count: infinite;
	}

	/*@-moz-keyframes blinker {  
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}

	@-webkit-keyframes blinker {  
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}

	@keyframes blinker {  
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}*/
	.onupdate,.onhapus{
		display: none;
	}
	.opt{
		padding: 5px;
	}
	*{
		text-transform: uppercase;
		font-family: arial;
	}
	.cari-menu{
		padding: 10px;
		border-radius:10px;
		/*margin-left:30px;*/
		width: 300px;
	}
	.cari-menu-salon{
		padding: 10px;
		border-radius:10px;
		/*margin-left:30px;*/
		width: 300px;
	}
	.judul{
		color: white;
		text-align: center;	
	}
	body{
		/*background-image: url('images/back-red.jpg');*/
		
	}
	#wrapper-menu{
		z-index: 100;
		height: 100vh;
		position: absolute;
		background-color: black;
		top: 0px;
		left: 0px;
		width: 100vw;
		display: none;
	}
	#container-menu{
		z-index: 100;
		position: absolute;
		background-color: black;
		width: 100vw;
		/*height: 100%;*/
		/*height: 100%;*/
		top: 0px;
		left: 0px;
		display: none;
		padding: 20px;
		box-sizing:border-box;
		/*margin: 20px;*/
		/*background: red;*/
	}
	#container-menu #isimenu{
		width: 60vw;
	}
	#container-menu #isimenu1{
		width: 60vw;
	}
	#container-menu #isimenu2{
		width: 60vw;
	}
	.wrap-menu{
		display: inline-block;
		margin: 5px;
		width: 16%;
		border: 1px solid black;
		padding :10px;
		border-radius: 10px;
		background: white;

	}
	.wrap-menu .menu{
		width: 100px;
		height: 100px;
		border-radius:50%;
		margin:0 auto;
	} 
	.price{
		font-size: 20px;
		color: red;
		text-align: center;
		border: 1px solid black;
		border-radius:10px;
		margin-top:5px;
	}
	#logout{
		position: absolute;
		right: 20px;
		top: 20px;
	}
	#logout li{
		display: inline;
	}
	#logout li a{
		color: white;
		text-decoration: none;
	}
	#logout li a:hover{
		color: red;
		text-decoration: none;
	}
	.menu-name{
		font-size: 10px;
		font-weight: bolder;
		text-align: center;
	}
	.no-meja{
		
		transition:background-color 600ms;
		-moz-transition:background-color 600ms;
		-webkit-transition:background-color 600ms;
		/*padding-top:60px;*/
		box-sizing:border-box;
		cursor: pointer;
		font-size: 20px;
		text-align: center;
		width: 170px;
		height: 170px;
		background: white;
		border:5px solid black;
		display: inline-block;
		margin:10px;
		border-radius: 10px;
		border-radius:50%;
		content: "kosong";	
		color:white;
		/*background-image:url('images/call.jpg');		/*content: "TERISI";*/*/
		background-size:100% 100%; 

	}
	.sheet li{
		display: inline;
		list-style: none;
		color: white;
		font-weight: bolder;
		margin-left:1px;
		background: black;
		padding: 10px;
		border-top-left-radius:10px;
		border-top-right-radius:10px;
		cursor: pointer;
	}
	.hide{
		display: none;
	}
	.active{
		display: block;
	}
	.no-meja:hover{
		background-color: white!important;
	}
	.close,.close-full{
		position: absolute;
		top: 0px;
		right: 0px;
		width: 30px;
		height: auto;
		/*color:white;*/
		cursor: pointer;
	}
	.add{
		font-size: 15px;
		height: 20px;
		color: white;
		text-align: center;
		border: 1px solid black;
		border-radius:10px;
		margin-top:5px;
		background-color:black; 
		cursor: pointer;
	}
	#faktur{

		width: 35vw;
		height: 100%;
		background: white;
		position: fixed;
		right: 0px;
		top: 0px;
		padding: 10px;
	}
	#faktur table tr td{
		border:1px solid black;
	}
	#faktur table {
			width: 100%;
		border:1px solid black;

	}
	.terisi{
		background-image:url('images/waitres.png')!important;		/*content: "TERISI";*/
		background-size:100% 100%; 
		background-color: black;
		border:2px solid white;
	}
	.belum-pulang{
		background-image:url('images/back-red.jpg')!important;		/*content: "TERISI";*/
		background-size:100% 100%; 
		background-color: black;
		border:2px solid white;
	}
	.angka-meja{
		background-color: black;
		width: 30px;
		height: 30px;
		border-radius:50%;
		-webkit-border-radius:50%;
		-moz-border-radius:50%;
	}

#items thead{
		background: black;
		color: white;
		padding: 5px;
	}
	#items thead tr td{
		font-size: 12px;
	}
	#items tbody tr td{
		border:0px solid black;
	}
	#items {
		border:0px solid black;

	}

	.option-meja{
		padding: 5px;
	}
	.waiter-name{
		text-transform: capitalize;
		background-color: black;
		border-radius:20px;
		position: relative;
		top:95px;
		overflow: hidden;
	}
	.jconfirm-scrollpane .container{
		width: 300px;
		margin: 0 auto;
	}
	.jconfirm-scrollpane{
		background-color: rgba(1,1,1,0.5);
	}
	.jconfirm-scrollpane .btn{
		position: relative;
		width:auto; 
	}
	.btn-default{
		color:white;
		background-color: black;
	}
</style>