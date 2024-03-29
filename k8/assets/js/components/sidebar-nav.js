jQuery(document).ready(function ($) {
	$(".k8side__wraper").css("display", "flex");
	// if(checkMobile()){
	//   $(".k8side__wraper").css("display", "flex");
	// }
	// else{
	//   $(".k8side__wraper").css("display", "block");
	// }
	const Reset = function (obj) {
		obj.btn.removeClass("active");
		obj.menu.removeClass("active");
		Icon(obj.icon);
	};

	const Icon = function ($icon) {
		if ($icon.hasClass("fa-list-ul")) {
			$icon.removeClass("fa-list-ul");
			$icon.addClass("fa-times-circle");
		} else {
			$icon.removeClass("fa-times-circle");
			$icon.addClass("fa-list-ul");
		}
	};

	const Setup = function () {
		let $wrapper = $(".k8side__wraper"),
			txt = $wrapper.attr('data-txt'),
			html_els = '<div class="k8side__item k8side__item-1"><button class="k8side__button k8side__button-1" style="display: flex; flex-direction: column; align-items: center; padding: 10px;"><i class="fas fa-list-ul"></i> <span style=" writing-mode: tb-rl; transform: rotate(180deg); margin-bottom: 12px;">'+txt+'</span> </button><ul class="k8side__menu"></ul></div>',

			$titlz = $("body main#main h2:visible").not(".wppr-review-container h2"),
			$toc_cont = $('#ez-toc-container');


			$wrapper.append(html_els);
			let $btn = $wrapper.find(".k8side__button-1"),
				$item = $btn.parent(".k8side__item"),
				$menu = $btn.siblings(".k8side__menu"),
				c = 1;
			/*For desktop margin left*/
			if (!checkMobile()) {
				let $content = $(".footer-widgets-container");
				if ($content.length == 0) {
					$content = $(".copyright-bar");
				}
				let left = $content.outerWidth() / 2 + $wrapper.outerWidth();
				$wrapper.css({
					"margin-left": "-" + left + "px",
					left: 50 + "%",
				});
			}

		/*
		if Table of contents presents on page
		- just copy items from it
		 */
		if($toc_cont.length > 0){
			let $toc_links = $toc_cont.find('.ez-toc-list li a');
			$toc_links.each(function(index, el) {
				$menu.append(
					'<li><a href="' + $(el).attr('href') + '" rel="nofollow">' + $(el).text() + '</a></li>'
				);
			});
			return false;
		}

		if ($titlz.length == 0) {
			$titlz = $("body main#main h1:visible");
		}
		if ($titlz.length == 0) {
			return false;
		}

		$titlz.each(function (index, title) {
			let $title = $(title);
			/*skip empty titles*/
			if ($title.text() == "") {
				return true;
			}
			$title.attr("id", "head_" + c);
			$menu.append(
				'<li><a href="#head_' +
					c +
					'" rel="nofollow">' +
					$title.text().slice(0, 35) +
					"...</a></li>"
			);
			c++;
		});
	};
	Setup();

	const Clickz = function () {
		let $menu = $(".k8side__menu"),
			$over = $(".k8side__over"),
			btn = ".k8side__button-1",
			$btn = $(btn),
			$icon = $btn.find("i"),
			b = "body";
		if ($menu.length == 0 || $btn.length == 0 || $icon.length == 0) {
			console.log("Not enough elements");
			return false;
		}
		$(b).on("click", btn, function (e) {
			e.preventDefault();
			Icon($icon);
			$btn.toggleClass("active");
			$menu.toggleClass("active");
		});
		$(b).on("click", ".k8side__menu a", function (e) {
			$over.addClass("active");
			Reset({
				btn: $btn,
				menu: $menu,
				icon: $icon,
			});
			setTimeout(function () {
				$("html, body").animate(
					{
						scrollTop: $(window).scrollTop() - 160,
					},
					600,
					function () {
						$over.removeClass("active");
					}
				);
			}, 100);
		});

		$(b).on("click", ".ez-toc-list a.ez-toc-link", function (e) {
			e.preventDefault();
			let $clicked = $(this),
					$toc_cont = $clicked.closest('#ez-toc-container'),
					offsetTop = ($($clicked.attr('href')).offset().top - 100);
			$('html, body').animate({
				scrollTop: offsetTop
			}, 600);
			window.location.hash = $clicked.attr('href');
			$toc_cont.removeClass('active');
		});

		$(b).on('click', '.ez-toc-title-container', function(e) {
			e.preventDefault();
			$(this).parent().toggleClass('active');
			/* Act on the event */
		});

		// Open||Close fast affiliate|share links
		let currIcon = "";
		$(b).on("change", ".k8side__fast-open", function (e) {
			e.preventDefault();
			let $check = $(this),
				$parent = $check.parent(),
				$i = $check.siblings(".k8side__fast-open-button").find("i");

			if (this.checked) {
				$(b).addClass("ov-hidd");
				$parent.addClass("active");
				$over.addClass("active");
				currIcon = $i.attr("class");
				$i.attr("class", "fas fa-times-circle");
			} else {
				$(b).removeClass("ov-hidd");
				$parent.removeClass("active");
				$over.removeClass("active");
				$i.attr("class", currIcon);
			}
			/* Act on the event */
		});
		$(b).on("change", ".k8side__fast-open--affiliate", function (e) {
			// if (this.checked && gtag) {
			// 	gtag("event", "Click on Fast Affiliates", {
			// 		event_category: "Fast Affiliates open",
			// 	});
			// } else if (gtag) {
			// 	gtag("event", "Click on Fast Affiliates", {
			// 		event_category: "Fast Affiliates close",
			// 	});
			// }
		})
		$(b).on("change", ".k8side__fast-open--share", function (e) {
			// if (this.checked && gtag) {
			// 	gtag("event", "Open fast share", {
			// 		event_category: "Social Network",
			// 		non_interaction: true
			// 	});
			// } else if (gtag) {
			// 	gtag("event", "Close fast share", {
			// 		event_category: "Social Network",
			// 		non_interaction: true
			// 	});
			// }
		})
		$(b).on("click", ".k8side__fast-item--share", function (e) {
			// if (gtag) {
			// 	let postIdEl = document.querySelector('meta[name="post:id"]')
			// 	let postTypeEl = document.querySelector('meta[name="post:type"]')
			// 	gtag("event", "share", {
			// 		event_category: "Social Network",
			// 		event_label: this.dataset.name,
			// 		method: this.dataset.name,
			// 		content_id: postIdEl ? postIdEl.content : undefined,
			// 		content_type: postTypeEl ? postTypeEl.content : undefined,
			// 		non_interaction: true
			// 	});
			// }
		})
	};
	Clickz();
});
