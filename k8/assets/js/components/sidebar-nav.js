jQuery(document).ready(function($) {
	$('.k8side__wraper').css('display', 'block');
	window.mobilecheckk = function() {
	  var check = false;
	  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
	  return check;
	};

	const Reset = function(obj){
		obj.btn.removeClass('active');
		obj.menu.removeClass('active');
		Icon(obj.icon);
	}

	const Icon = function($icon){
		if( $icon.hasClass('fa-list-ul') ){
			$icon.removeClass('fa-list-ul');
			$icon.addClass('fa-times-circle');
		}
		else{
			$icon.removeClass('fa-times-circle');
			$icon.addClass('fa-list-ul');
		}
	}

	const Setup = function(){
		let html_els = '<div class="k8side__item k8side__item-1"><button class="k8side__button k8side__button-1" style="display: flex; flex-direction: column; align-items: center; padding: 10px;"><i class="fas fa-list-ul"></i> <span style=" writing-mode: tb-rl; transform: rotate(180deg); margin-bottom: 12px;">Inhaltsverzeichnis</span> </button><ul class="k8side__menu"></ul></div>',
				$wrapper = $('.k8side__wraper'),
				$titlz = $('body main#main h2:visible').not(".wppr-review-container h2");
		if( $titlz.length == 0 ){
			$titlz = $('body main#main h1:visible')
		}
		if( $titlz.length == 0 ){
			return false;
		}
		$wrapper.append(html_els);
		let $btn = $wrapper.find('.k8side__button-1'),
				$item = $btn.parent('.k8side__item'),
				$menu = $btn.siblings('.k8side__menu'),
				c = 1;
		/*For desktop margin left*/
		if(!window.mobilecheckk()){
			let	$content = $('.footer-widgets-container');
			if( $content.length == 0 ){
				$content = $('.copyright-bar');
			}
			let	left = (($content.outerWidth() / 2) + $wrapper.outerWidth());
			$wrapper.css({
				'margin-left': '-' + left + 'px',
				'left' : 50 + '%',
			});
		}
		$titlz.each(function(index, title) {
			let $title = $(title);
			/*skip empty titles*/
			if( $title.text() == '' ){
				return true;
			}
			$title.attr('id', 'head_' + c);
			$menu.append('<li><a href="#head_' + c + '" rel="nofollow">' + $title.text().slice(0, 35) + '...</a></li>');
			c++;
		});
	}
	Setup();

	const Clickz = function(){
		let $menu = $('.k8side__menu'),
				$over = $('.k8side__over'),
				btn = '.k8side__button-1',
				$btn = $(btn),
				$icon = $btn.find('i');
		if( $menu.length == 0 || $btn.length == 0 || $icon.length == 0 ){
			console.log('Not enough elements');
			return false;
		}
		$('body').on('click', btn, function(e) {
			e.preventDefault();
			Icon( $icon );
			$btn.toggleClass('active');
			$menu.toggleClass('active');
		});
		$('body').on('click', '.k8side__menu a', function(e) {
			$over.addClass('active');
			Reset({
				'btn' : $btn,
				'menu' : $menu,
				'icon' : $icon
			});
			setTimeout(function(){
				$('html, body').animate({
				  scrollTop: $(window).scrollTop() - 160
				},600, function(){
					$over.removeClass('active');
				});
			}, 100);
		});
	}
	Clickz();
});