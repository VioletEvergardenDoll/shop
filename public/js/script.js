window.onload = function() {
		//需求：无缝滚动。
		//思路：赋值第一张图片放到ul的最后，然后当图片切换到第五张的时候
		//     直接切换第六章，再次从第一张切换到第二张的时候先瞬间切换到
		//     第一张图片，然后滑动到第二张
		//步骤：
		//1.获取事件源及相关元素。（老三步）
		//2.复制第一张图片所在的li,添加到ul的最后面。
		//3.给ol中添加li，ul中的个数-1个，并点亮第一个按钮。
		//4.鼠标放到ol的li上切换图片
		//5.添加定时器
		//6.左右切换图片（鼠标放上去隐藏，移开显示）
		var screen = document.getElementById("screen");
		var ul = screen.children[0];
		var ol = screen.children[1];
		var div = screen.children[2];
		var imgWidth = screen.offsetWidth;


		var key = 0;
		var square = 0;
		var timer = setInterval(autoPlay, 2000);
		screen.onmouseover = function(ev) {
			clearInterval(timer);
			div.style.display = "block";
		}
		screen.onmouseout = function(ev) {
			timer = setInterval(autoPlay, 2000);
			div.style.display = "none";
		}
		//6
		var divArr = div.children;
		divArr[0].onclick = function(ev) {
			key--;
			if (key < 0) {
				ul.style.left = -(ul.children.length - 1) * imgWidth + "px";
				key = 3;
			}
			animate(ul, -key * imgWidth);
			square--;
			if (square < 0) {
				square = 3;
			}
			for (var k = 0; k < len; k++) {
				olLiArr[k].className = "";
			}
			olLiArr[square].className = "current";
		}
		divArr[1].onclick = autoPlay;

		function autoPlay() {
			key++;
			//当不满足下面的条件是时候，轮播图到了最后一个孩子，进入条件中后，瞬移到
			//第一张，继续滚动。
			if (key > ul.children.length - 1) {
				ul.style.left = 0;
				key = 0;
			}
			animate(ul, -key * imgWidth);
			square++;
			if (square > 3) {
				square = 0;
			}
			for (var k = 0; k < len; k++) {
				olLiArr[k].className = "";
			}
			olLiArr[square].className = "current";
		}

		function animate(ele, target) {
			clearInterval(ele.timer);
			var speed = target > ele.offsetLeft ? 10 : -10;
			ele.timer = setInterval(function() {
				var val = target - ele.offsetLeft;
				ele.style.left = ele.offsetLeft + speed + "px";
				if (Math.abs(val) < Math.abs(speed)) {
					ele.style.left = target + "px";
					clearInterval(ele.timer);
				}
			}, 10)
		}
		//6.左右切换的按钮。
		    var btnArr = box.children[0].children[2].children;
		    btnArr[0].onclick = function () {
		        key--;
		        square--;
		        if(key<0){
		            key=4;
		            ul.style.left = -5*ul.children[0].offsetWidth + "px";
		        }
		        animate(ul,-key*ul.children[0].offsetWidth);
		 
		 
		        square = square<0?olLiArr.length-1:square;
		        for(var j=0;j<olLiArr.length;j++){
		            olLiArr[j].className = "";
		        }
		        olLiArr[square].className = "current";
		    }
		    btnArr[1].onclick = function () {
		        autoPlay();
		    }
	}