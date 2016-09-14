// Load more dynamic content when user scrolls to bottom of page
			scrollCount = 1;
			function yHandler(){
				var wrap = document.getElementById('wrap');
				var headerWrap = document.getElementById('headerWrap');
				var wrapperRealSize = document.getElementById('wrapperRealSize');
				var contentHeight = headerWrap.offsetHeight + wrapperRealSize.offsetHeight;
				var yOffset = window.pageYOffset;
				var y = yOffset + window.innerHeight;
				if(y >= contentHeight){
					// Ajax call to get more dynamic data goes here
					var ajax = ajaxObj("GET", "php_parsers/feedScroll.php");
			        ajax.onreadystatechange = function() {
				        if(ajaxReturn(ajax) == true) {
				        	var datArray = ajax.responseText.split("|");
							//if(datArray[0] == "reply_ok"){
							//	var rid = datArray[1];
							//}
							//alert('hello');
							//alert(datArray.length);
							if (scrollCount == 1){
								wrap.insertAdjacentHTML('beforeend', '<div class="newData"> '); 
				        		for (var i = 8; i < 14; i++) {
				        			if (datArray[i] != undefined){
										wrap.insertAdjacentHTML('beforeend', datArray[i]); 
									}
				        		}
				        		wrap.insertAdjacentHTML('beforeend', '</div>');
				        	} else if (scrollCount == 2){
				        		wrap.insertAdjacentHTML('beforeend', '<div class="newData"> '); 
				        		for (var i = 15; i < 21; i++) {
				        			if (datArray[i] != undefined){
				        				wrap.insertAdjacentHTML('beforeend', datArray[i]);
			        				} 
				        		}
				        		wrap.insertAdjacentHTML('beforeend', '</div>');
				        	} else if (scrollCount == 3){
				        		wrap.insertAdjacentHTML('beforeend', '<div class="newData"> '); 
				        		for (var i = 22; i < 28; i++) {
				        			if (datArray[i] != undefined){
				        				wrap.insertAdjacentHTML('beforeend', datArray[i]); 
				        			}
				        		}
				        		wrap.insertAdjacentHTML('beforeend', '</div>');
				        	}
				        	//wrap.innerHTML += ajax.responseText;
				        	scrollCount += 1;
				        	//wrap.innerHTML += ajax.responseText;

				        }
			        }
			        ajax.send();
				}
				var status = document.getElementById('status');
				status.innerHTML = contentHeight+" | "+y+" | "+wrap.offsetHeight;
			}
			window.onscroll = yHandler;