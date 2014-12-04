//
var globalArrayWithThePhotos = new Array();

//
function loadPhotoArray(){
	var raiz = "http://farm4.static.flickr.com/";
	globalArrayWithThePhotos = new Array(
							{o: raiz+"3615/3313269321_d60c8e67a7.jpg", m: new Image()},
							{o: raiz+"3454/3316761729_2b5af8302b.jpg", m: new Image()},
							{o: raiz+"3577/3319342003_f09cd410be.jpg", m: new Image()},
							{o: raiz+"3348/3316762161_7b6b0d50ac.jpg", m: new Image()},
							{o: raiz+"3441/3316761329_1c9236fed6.jpg", m: new Image()},
							{o: raiz+"3611/3314095962_7efb8fa299.jpg", m: new Image()},
							{o: raiz+"3649/3314118858_889256bda9.jpg", m: new Image()},
							{o: raiz+"3325/3314095668_a7fd93e08c.jpg", m: new Image()},
							{o: raiz+"3301/3319630573_966e000661.jpg", m: new Image()},
							{o: raiz+"3510/3319618837_85e13812f9.jpg", m: new Image()},
							{o: raiz+"3648/3320719372_ed71d733eb.jpg", m: new Image()},
							{o: raiz+"3638/3319976405_cf5f89e7e6.jpg", m: new Image()},
							{o: raiz+"3597/3313231781_82b715bda9.jpg", m: new Image()},
							{o: raiz+"3476/3314051714_5902bc97e3.jpg", m: new Image()},
							{o: raiz+"3597/3314085192_24fcfc9895.jpg", m: new Image()},
							{o: raiz+"3474/3314118264_6734691517.jpg", m: new Image()},
							{o: raiz+"3582/3314095764_6dbc4962d2.jpg", m: new Image()},
							{o: raiz+"3144/3313279661_f4d8e7792b.jpg", m: new Image()},
							{o: raiz+"3637/3321632485_4f233c9b25.jpg", m: new Image()},
							{o: raiz+"4097/4892372576_91f33983bb.jpg", m: new Image()},
							{o: raiz+"4149/4946882124_7f28f8d520.jpg", m: new Image()},
							{o: raiz+"4081/4892351670_e86af9edd3.jpg", m: new Image()},
							{o: raiz+"2552/3839588650_d5c2bbdf5b.jpg", m: new Image()},
							{o: raiz+"3657/3322621724_5c3b0f6853.jpg", m: new Image()},
							{o: raiz+"3548/3660425909_dd7ebae1fd.jpg", m: new Image()},
							{o: raiz+"3580/3320074663_c0ae45a47d.jpg", m: new Image()}
						);

	for(var cont=0; cont<globalArrayWithThePhotos.length; cont++){
		globalArrayWithThePhotos[cont].m.src = globalArrayWithThePhotos[cont].o.substr(0, globalArrayWithThePhotos[cont].o.length-4) + "_m.jpg";
		globalArrayWithThePhotos[cont].m.style.border = "1px solid #4A5358";
	}
}

//
function temporizador(){
	var randomnumber=Math.floor(Math.random() * globalArrayWithThePhotos.length);				

	$("#randomPhoto").attr({ href: globalArrayWithThePhotos[randomnumber].o});
	$("#randomPhoto").html("");
	$("#randomPhoto").append(globalArrayWithThePhotos[randomnumber].m);

	if(($("#randomPhoto img")).width() > ($("#randomPhoto img")).height()){
		$("#randomPhoto img").css('width', '180px');
		$("#randomPhoto img").css('height', '135px');
	}else{
		$("#randomPhoto img").css('height', '180px');
		$("#randomPhoto img").css('width', '135px');
	}
}

//
function fixBugInChrome(){
	$(".tableLinks tr").each(function(){
			$(this).css('height', '53px');
		}
	);
	
	$(".tableLinks td").each(function(){
			$(this).css('height', '53px');
		}
	);
}
