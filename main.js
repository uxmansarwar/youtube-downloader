window.addEventListener("load", (_) => {
	// setTimeout(function () {
	// 	url = "//assets.codepen.io/images/codepen-logo.svg";
	// 	downloadFile(url); // UNCOMMENT THIS LINE TO MAKE IT WORK
	// }, 2000);

	// // Source: http://pixelscommander.com/en/javascript/javascript-file-download-ignore-content-type/
	// window.downloadFile = function (sUrl) {
	// 	//iOS devices do not support downloading. We have to inform user about this.
	// 	if (/(iP)/g.test(navigator.userAgent)) {
	// 		//alert('Your device does not support files downloading. Please try again in desktop browser.');
	// 		window.open(sUrl, "_blank");
	// 		return false;
	// 	}

	// 	//If in Chrome or Safari - download via virtual link click
	// 	if (window.downloadFile.isChrome || window.downloadFile.isSafari) {
	// 		//Creating new link node.
	// 		var link = document.createElement("a");
	// 		link.href = sUrl;
	// 		link.setAttribute("target", "_blank");

	// 		if (link.download !== undefined) {
	// 			//Set HTML5 download attribute. This will prevent file from opening if supported.
	// 			var fileName = sUrl.substring(sUrl.lastIndexOf("/") + 1, sUrl.length);
	// 			link.download = fileName;
	// 		}

	// 		//Dispatching click event.
	// 		if (document.createEvent) {
	// 			var e = document.createEvent("MouseEvents");
	// 			e.initEvent("click", true, true);
	// 			link.dispatchEvent(e);
	// 			return true;
	// 		}
	// 	}

	// 	// Force file download (whether supported by server).
	// 	if (sUrl.indexOf("?") === -1) {
	// 		sUrl += "?download";
	// 	}

	// 	window.open(sUrl, "_blank");
	// 	return true;
	// };
	// window.downloadFile.isChrome =
	// 	navigator.userAgent.toLowerCase().indexOf("chrome") > -1;
	// window.downloadFile.isSafari =
	// 	navigator.userAgent.toLowerCase().indexOf("safari") > -1;

	results = document.querySelector("#results");
	loader = document.querySelector("#loader");
	search_vid = document.querySelector("#search_vid");
	let $_ajax = (url, params = {}) =>
		new Promise(async (accept, reject) => {
			if (url.trim().length < 1) {
				reject("invalid Url");
			}
			let query_string = "";
			if (Object.keys(params).length > 0) {
				query_string = $.param(params);
			}
			$.ajax({
				url: url,
				type: "POST",
				processData: false,
				dataType: "json",
				data: query_string,
				success: (data) => accept(data),
				error: (request, status, error) => {
					console.log("Error in request submission", error);
					reject({ request, status, error });
				},
			});
		});

	// console.log("dlkfsaks");
	// document.querySelector("iframe").addEventListener("canplay", (_can_play) => {
	// 	console.log("can play");
	// });
	search_vid.addEventListener("click", async (_search) => {
		let user_url = document.querySelector("#user_url").value.trim();
		console.log("dflsdfk");
		if (user_url.length > 3) {
			loader.classList.remove("d-none");
			search_vid.disabled = true;
			await $_ajax(
				"http://localhost/youtube-downloader/ajax_files/vid_info.py",
				{ user_url }
			).then((data) => {
				console.log(data["video_title"]);
				loader.classList.add("d-none");
				search_vid.disabled = false;
				if (data["video_title"] != "" && data["dl_url"] != "") {
					results.classList.remove("d-none");
					results.querySelector("#video_title").innerHTML = data["video_title"];
					let _url = data["dl_url"].split(data["video_id"]);
					_url =
						"http://localhost/youtube-downloader/dl_files/" +
						data["video_id"] +
						"/" +
						_url[1];
					results.querySelector("a").href = _url;
					results.querySelector("iframe").src =
						"https://www.youtube.com/embed/" + data["video_id"];
					// downloadFile(data["dl_url"]);
					// results.querySelector("#tst").innerHTML = data["dl_url"];
				} else {
					results.querySelector("#video_title").innerHTML =
						"Something Went Wrong";
				}
			});
		}
	});
});
