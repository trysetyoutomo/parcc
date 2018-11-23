<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	var default_sheet = 1;
	var username = "<?php echo Yii::app()->user->id; ?>"
	function reloadmeja(){
	    $.ajax({
	        url: "<?php echo Yii::app()->createUrl("site/reloadmeja")?>",
	        cache: true,
	        data : "default_sheet="+default_sheet,
	        success: function(msg){
				$('#meja').html(msg);
				setSheet(default_sheet);
	        }
	    });
	}

		reloadmeja();
		setInterval(function(){
			 // reloadmeja(); 
		}, 1000);

		var meja;
		var meja_tipe = "null";
		var status = "insert";
		var status_meja = '';

	$("#combo-meja").click(function(e){
		// alert(status_meja);
		if (status_meja=='pindah'){
			$('.option-pindah').show();
			$('.option-gabung').hide();
		}else if (status_meja=='gabung'){
			$('.option-gabung').show();
			$('.option-pindah').hide();
		}
	});
	$("#login-waiter").change(function(e){
		if ($(this).val()!=""){
			var username = $(this).val();
			var password = $(this).val();
			// var password = prompt("silahkan masukan password ","");
			
			var cek = $.ajax({
						url : "<?php echo Yii::app()->createUrl('site/cekpassword'); ?>",
						data : "username="+username+"&password="+password,
						success:function(data){},
						dataType: "text", 
						async: false
					}).responseText;	
			// alert(cek);


			if (cek==true){
				// alert(cek);
				window.location.reload();
			}else{
				// alert(cek);
				alert("password salah");
				window.location.reload();
			}
		}
	});

	$("#combo-meja").change(function(e){
		// alert(status_meja);
		var meja_baru = $(this).val();
		if (status_meja=='pindah'){	
			
			var c =confirm(' Yakin pindah meja ?  ');
			if (!c){ return false;}
				$.ajax({
					url : "<?php echo Yii::app()->createUrl('site/updatetable'); ?>",
					data : "mjl="+meja+"&mjb="+meja_baru,
					success:function(data){
						// alert(data);
						reloadmeja();

						// $('#items tbody').html(data);
						$('#full').hide();
						$('#list-meja').hide();
						$('.close').trigger('click');
					}
				});

		}else if (status_meja=='gabung'){
			// $('.option-gabung').show();
			var c =confirm(' Yakin gabung meja ?  ');
			if (!c){ return false;}
			$.ajax({
				url : "<?php echo Yii::app()->createUrl('site/gabungmeja'); ?>",
				data : "mjl="+meja+"&mjb="+meja_baru,
				success:function(data){
					// alert(data);
					reloadmeja();

					// $('#items tbody').html(data);
					$('#full').hide();
					$('#list-meja').hide();
					$('.close').trigger('click');
				}
			});	
		}



		// alert(nilai);
	});


	$(".kirim").click(function(e){
		// alert(cetakbardapur());
		// alert("TEST");
		if (!cetakbardapur(meja,meja_tipe)){
			exit;

		}
		// var c =confirm('simpan menu , ke dalam meja  ? ');
		// if (!c){
		// 	return false;	
		// }	
	// alert('masuk');		
		var jml = $('.baris').length;
		var jsonObj = [];
		var inch = 0;
		var tanggal  = $('#tanggal').val();
		var user  = $('#user').val();
		var pemasok  = $('#nama_pemasok').val();
		var namapel = $('#namapel').val();
		var namapeg = $('#namapeg').val();
		// alert(namapeg);
		
		var head = {
			tanggal : tanggal,
			user : user,
			pemasok : pemasok,
			meja : meja
		}
		// alert(JSON.stringify(head));
		// alert		
			$(".baris").each(function() {
				var idb = $(this).find('.pk').html();
				var jml = $(this).find('.jumlah').find('.input-jumlah').val();
				var cetak = $(this).find('.pk').attr('cetak');
				var permintaan = $(this).find('.permintaan').find('.area-permintaan').val();
				item = {}
					item["idb"] = idb;
					item["jml"] = jml;
					item["cetak"] = cetak;
					item["permintaan"] = permintaan;
				jsonObj.push(item);
			});
			// alert(JSON.stringify(jsonObj));
			if ($('.baris').length==0){
				alert('menu masih kosong');
				return false;
			}

			 $.ajax({
				url: '<?php echo Yii::app()->createAbsoluteUrl('site/waiterkirim'); ?>', 
				data: {
					jsonObj :jsonObj,
					head :head,
					namapel : namapel,
					namapeg : namapeg
				},
				success: function(result){
					// alert(result);
					// alert("Menu Telah ditambahkan");
					$('#container-menu').hide();
					$('#wrapper-menu').hide();
					reloadmeja();
					// window.location.reload();
					// alert(result);
					// alert('haha');
				},
				error:function(result){
					// console.log(result);
					// alert(JSON.stringify(result));
					alert('data tidak boleh kosong');
				}
			});
		$('#namapel').val('');
		$('#namapeg').val('');
			

	});
		// }
		var public_index ;
		$(document).on("click",".hapus",function(e){	
			public_index = $('.hapus').index(this);
			var cek = $('.baris').eq(public_index).find(".pk").attr("cetak");
			var siid = $('.baris').eq(public_index).find(".pk").attr("siid");
			// // alert(cek);
			if (cek==0){
				$('.baris').eq(public_index).remove();			
			}else{
				$("#fullscreen").fadeIn();	
				$("#form-auth").fadeIn();
				$("#siid").val(siid);
			}
			// 	var password = prompt("masukan password supervisor ! ");
			// 	if (password=="superbani"){
			// 		$('.baris').eq(index).remove();			
			// 	}else{
			// 		alert("password salah");
			// 	}
			// }
		});
		$(document).on("click",".spoile",function(e){	
			public_index = $('.spoile').index(this);
			var cek = $('.baris').eq(public_index).find(".pk").attr("cetak");
			var siid = $('.baris').eq(public_index).find(".pk").attr("siid");
			// alert(siid);
			if (cek==0){
				alert("pilih hapus untuk menghapus items")			
				// $('.baris').eq(public_index).remove();
			}else{
				$("#fullscreen").fadeIn();	
				$("#form-authS").fadeIn();
				$("#siid").val(siid);	
			}
		});
		$(document).on("submit","#auth-formS",function(e){
			e.preventDefault();
			var data = $("#auth-formS").serialize();
			// alert(data);
			 $.ajax({
				url: '<?php echo Yii::app()->createAbsoluteUrl('site/uservoid'); ?>', 
				data: data,
				success: function(result){
					// alert(result)
					if (result=="authorized"){
						var datasiid = $("#siid").val();
						// alert(datasiid);
						// alert("Berhasil");
						$.ajax({
							url: '<?php echo Yii::app()->createAbsoluteUrl('site/spoile'); ?>', 
							data: {
								datasiid :datasiid,
							},
							success: function(result){
								// alert(result)
								$('.baris').eq(public_index).remove();
							},
							error:function(result){
								alert(JSON.stringify(result));
							}
						});
						$("#fullscreen").fadeOut();	
						$("#form-authS").fadeOut();
						$("#auth-formS input[type='text']").val("");		
						$("#auth-formS input[type='password']").val("");
					}else{
						alert(result);
					}
				},
				error:function(result){
					alert(JSON.stringify(result));
					// alert('data tidak boleh kosong');
				}
			});

		});
		$(document).on("click","#fullscreen",function(e){
			$("#fullscreen").fadeOut();
			$("#form-auth").fadeOut();
			$("#form-authS").fadeOut();
		});
		$(document).on("submit","#auth-form",function(e){
			e.preventDefault();
			var data = $("#auth-form").serialize();
			// alert(data);
			 $.ajax({
				url: '<?php echo Yii::app()->createAbsoluteUrl('site/uservoid'); ?>', 
				data: data,
				success: function(result){
					// alert(result)
					if (result=="authorized"){
						$('.baris').eq(public_index).remove();
						$("#fullscreen").fadeOut();	
						$("#form-auth").fadeOut();
						$("#auth-form input[type='text']").val("");		
						$("#auth-form input[type='password']").val("");
					}else{
						alert(result);
					}
				},
				error:function(result){
					alert(JSON.stringify(result));
					// alert('data tidak boleh kosong');
				}
			});

		});

		// $(document).on("click",".jumlah",function(e){
		// 	var index = $(".jumlah").index(this);
		// 	var cek = $('.baris').eq(index).find(".pk").attr("cetak");
		// 	alert(cek);
		// });

		$(document).on("click",".onhapus",function(e){
			var password = prompt("masukan password supervisor ! ");
			if (password=="725269.09"){
				// $('.baris').eq(index).remove();			
				// var c = confirm("hapus isi menu  ? ");
				// if (!c){return false;}

				//hapus meja try
				var jml = $('.baris').length;
				var jsonObj = [];
				var inch = 0;
				var tanggal  = $('#tanggal').val();
				var user  = $('#user').val();
				var pemasok  = $('#nama_pemasok').val();
				var namapel = $('#namapel').val();
				// alert(namapel);
				
				var head = {
					tanggal : tanggal,
					user : user,
					pemasok : pemasok,
					meja : meja
				}
				// alert(JSON.stringify(head));
				// alert		
					$(".baris").each(function() {
					var idb = $(this).find('.pk').html();
						var jml = $(this).find('.jumlah').find('.input-jumlah').val();
						var permintaan = $(this).find('.permintaan').find('.area-permintaan').val();
						item = {}
							item["idb"] = idb;
							item["jml"] = jml;
							item["permintaan"] = permintaan;
						jsonObj.push(item);
					});
					// alert(JSON.stringify(jsonObj));
					if ($('.baris').length==0){
						alert('menu masih kosong');
						return false;
					}

					 $.ajax({
						url: '<?php echo Yii::app()->createAbsoluteUrl('site/waiterhapus'); ?>', 
						data: {
							jsonObj :jsonObj,
							head :head,
							namapel : namapel
						},
						success: function(result){
							// alert(result);
							// alert("Menu Telah ditambahkan");
							$('#container-menu').hide();
							$('#wrapper-menu').hide();
							reloadmeja();
							// window.location.reload();
							// alert(result);
							// alert('haha');
						},
						error:function(result){
							alert(JSON.stringify(result));
							alert('data tidak boleh kosong');
						}
					});
				$('#namapel').val('');
			}else{
				alert("password salah");
			}
		});
		
		$(document).on("click",".terisi",function(e){
			// alert('masuk');
			// if (username)
			// waiter-name
			var index = $('.terisi').index(this);
			var level = '<?php echo Yii::app()->user->getLevel();?>';
			// alert(level);
			// alert(index);
			var username_exist = $('.terisi').eq(index).find('.waiter-name').html();
			// alert(username_exist);
			username_exist = username_exist.toLowerCase();
			username = username.toLowerCase();
			username_exist = username_exist.trim();
			username = username.trim();

			// alert(username_exist);
			// alert(username);
			if (username!=username_exist && level!='6'){
				alert('anda tidak berhak membuka ini');
				return false;
			}

			// if (level!='6' && level!='7'){
			// 	alert('anda tidak berhak membuka ini');
			// 	return false;
			// }

			//else 

			// else{
			// 	alert('hahaha');
			// }
			var c = confirm("Perbaharui menu ? ");
			if (!c){
				return false;
				// exit;
			}
				status = "update";
				// alert(status);
				if (status=='update'){
					$('.onupdate').show();
					$('.onhapus').show();
				}
				// }else{
				// 	$('.onupdate').hide();

				// }
				meja = $(this).attr("value");
				meja_tipe = $(this).attr("tipe_meja");
				
				
				//alert(meja_tipe)
				$.ajax({
					url : "<?php echo Yii::app()->createUrl('site/getmenutable'); ?>",
					data : "table="+meja,
					beforeSend:function(){
						$('#items tbody').html(" Loading .. ");
					},
					success:function(data){
						// alert(data);
						$('#items tbody').html(data);
						// $('#isimenu').html(data);
					}
				});
				$('#wrapper-menu').show();
				$('#container-menu').show();
				// $("#container-menu").show();
				// alert(meja);
				// alert(index);
			

		});
		$(document).on("click",".sheet-meja",function(e){
			// var index = $('.sheet-meja').index(this);
			var value = $(this).attr("val");
			default_sheet = value;
			// alert(index);
			setSheet(value);
		});
		function setSheet(value){
			$('.sheet-meja').css("background","black");
			var baru = ".sheet"+value;
			$('.hide').hide();
			$(""+baru+"").show();
			// $("").css("background","red");
			$('.sheet-meja[val="'+value+'"]').css("background","red");
		}

		$(document).on("click",".no-meja",function(e){
				// $('.onupdate').hide();
			// alert($(this).attr("value"));
			// $('')	
			// alert(status);
			// status = "insert";
			// if (status=='insert')
			// 	$('.onupdate').hide();
			// }else{
			if ($(this).hasClass('terisi'))
				console.log('ada');
			else{
				$('.onupdate').hide();
				$('.onhapus').hide();
				$('#wrapper-menu').show();
				$('#container-menu').show();
				$('#items tbody').html(" ");
			}

			// }

			meja = $(this).attr("value");
			meja_tipe = $(this).attr("tipe_meja");
			// alert(meja); 
			if (meja_tipe == "cafe") {
					$('#aaaaa').show();
					$('#bbbbb').hide();
					$('#isimenu').show();
					$('#isimenu1').hide();
					$('#isimenu2').hide();
				}else if(meja_tipe == "cowork"){
					$('#aaaaa').show();
					$('#bbbbb').hide();
					$('#isimenu').hide();
					$('#isimenu1').show();
					$('#isimenu2').hide();
				}else if(meja_tipe == "take away"){
					$('#aaaaa').show();
					$('#bbbbb').hide();
					$('#isimenu').show();
					$('#isimenu1').hide();
					$('#isimenu2').hide();
				}else if(meja_tipe == "owner"){
					$('#aaaaa').show();
					$('#bbbbb').hide();
					$('#isimenu').show();
					$('#isimenu1').hide();
					$('#isimenu2').hide();
				}else if(meja_tipe == "salon"){
					$('#aaaaa').hide();
					$('#bbbbb').show();
					$('#isimenu').hide();
					$('#isimenu1').hide();
					$('#isimenu2').show();
				};
			
		});
		$(document).on("click",".close-full",function(e){
			$('#full').hide();
			$('#list-meja').hide();
		});
		
		$(document).on("click",".onupdate",function(e){
			$('#combo-meja').load("<?php echo Yii::app()->createAbsoluteUrl('site/reloadoptionmeja') ?>")
			$('#full').show();
			$('#list-meja').show();

			status_meja = $(this).attr("status");
			// alert(status_meja);
			
		});

		$(document).on("click",".btn[status='cetak']",function(e){
			// alert('cetak');

		});
		$(document).on("click",".close",function(e){

			// var c = confirm('Data belum di simpan, Yakin tutup  ?');
			// if (c){	
				$('#container-menu').hide();
				$('#wrapper-menu').hide();
				$('#full').hide();
				$('#namapel').val('');
				$('#namapeg').val('');
			// var jumbar = $('.baris').length;
			// alert(jumbar);
			// }
			// alert($(this).attr("value"));
			// $('')	
		});
		$(document).on("click",".btn-cari-menu",function(e){
			// $('#container-menu').hide();
			// alert($(this).attr("value"));
			// $('')
			var val = $('.cari-menu').val();
			$.ajax({
				url : "<?php echo Yii::app()->createUrl('items/cari'); ?>",
				data : "query="+val,
				success:function(data){
					// alert(data);
					$('#isimenu').html(data);
				}
			});
		});


			var no = 1;
			$(document).on("click",".add",function(e){
				var id = $(this).attr("value");
				 $.ajax({
		        url : 'index.php?r=items/check',
		        data : 'id='+id,
		        success : function(data)
		        {
	        	var obj = jQuery.parseJSON(data);
	            var stok = 1;
				var count = $('.pk[nilai="'+id+'"][cetak="0"]').length;
				// var count_printed = $('.pk[cetak="1"]').length;
				// alert(count);
				if (count==0){
					// alert(obj.item_name);
					$('#items tbody').append(
						"<tr class='baris'>" +
						"<td style='display:none' cetak='0' class='pk' nilai="+id+" lokasi="+obj.lokasi+"  >" + id + "</td>" +
						"<td style='display:none'>" + no + "</td>" +
						"<td class='nama_menu'>" + obj.item_name + "</td>" +
						"<td class='jumlah'><input min='1' maxlength='2' style='width:40px' class='input-jumlah' type='number' value='" + stok + "'></td>" +
						"<td class='permintaan'><textarea  class='area-permintaan'></textarea>"+
						"<td class='cetak'>belum</td>"+
						"<td style='text-align:center' class='hapus' ><p >X</p></td>"+
						"</td>" +

						"</tr>"
					);
						//"<td style='text-align:center' class='spoile' ><p >X</p></td>"+
					no++;
				    $('#container-tabel').animate({
			          scrollTop: 10000
			        }, 1000);
				}
				else{
					// alert('masuk');

					var now = $('.pk[nilai="'+id+'"][cetak="0"]').closest('.baris').find('.jumlah').find('.input-jumlah').val();
					$('.pk[nilai="'+id+'"][cetak="0"]').closest('.baris').find('.jumlah').find('.input-jumlah').val(parseInt(now)+parseInt(stok));
				}
			
		            
			        },
			        error : function(data)
			        {
			        //alert(data);
			                
			        }
			    });

				
				
			});
		

	});
</script>