$(document).ready( function() {
	addSidebarLink();
	editSidebarLink();
});

function editSidebarLink() {

	$(".editSidebarLink").on("click", function() {
		var link = $(this);
		var linkId = link.data().id;
		var linkTitle = $("#title" + linkId).text();
		var linkAddress = $("#link" + linkId).text();
		var linkIsArchived = $("#isArchived" + linkId).text();
		$("#editSidebarLinkId").val(linkId);
		$("#editSidebarLinkTitle").val(linkTitle);
		$("#editSidebarLinkAddress").val(linkAddress);
		$("#editSidebarLinkisArchived").val(linkAddress);
		$('#editSidebarLinkModal').modal('show');
	});

	var editSidebarLinkForm = $('#editSidebarLinkForm');

    $("#editSidebarLinkForm input").on("blur", function() {
    	if(editSidebarLinkForm.hasClass("dirty")){
    		validateForm("editSidebarLinkForm");
    	}
    });


    $("#editSidebarLinkSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	editSidebarLinkForm.addClass("dirty");
    	var valid = validateForm("editSidebarLinkForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/editSidebarLinkController.php",
			data: editSidebarLinkForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					alert('link successfully editted. This message is ugly and will be replaced');
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				editSidebarLinkForm.trigger("reset");
				$('#editSidebarLinkModal').modal('hide');
			}
		});  
	});
}

function addSidebarLink() {
	var addSidebarLinkForm = $('#addSidebarLinkForm');

    $("#addSidebarLinkForm input").on("blur", function() {
    	if(addSidebarLinkForm.hasClass("dirty")){
    		validateForm("addSidebarLinkForm");
    	}
    });


    $("#addSidebarLinkSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	addSidebarLinkForm.addClass("dirty");
    	var valid = validateForm("addSidebarLinkForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/addSidebarLinkController.php",
			data: addSidebarLinkForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					alert('link successfully added. This message is ugly and will be replaced');
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				addSidebarLinkForm.trigger("reset");
				$('#addSidebarLinkModal').modal('hide');
			}
		});  
	});
}