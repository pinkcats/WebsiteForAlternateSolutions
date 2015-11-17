//Here we will put global js stuff
$(document).ready(function(){
	updateActiveHeaderItem();
});

function updateActiveHeaderItem() {
	
	//returns last item in path, ex "index.php"
	var currentFile = window.location.pathname.split('/').pop();
	currentFile = (isService(currentFile)) ? "services.php" : currentFile;
	
	//then the list item of the current active link
	var activeElement = $("a[href^='" + currentFile + "']").parent();
	$("#navbar li").removeClass("active");
	activeElement.addClass("active");

}

function isService(fileName){
	var isServiceFile = false;
	switch(fileName) {
		case "mediation.php":
		case "facilitation.php":
		case "consultation.php":
		case "coaching.php":
		case "training.php":
			isServiceFile = true;
			break;
	}
	return isServiceFile;
}