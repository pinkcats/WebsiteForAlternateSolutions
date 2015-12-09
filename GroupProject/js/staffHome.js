$(document).ready( function() {
	addSidebarLink();
	editSidebarLink();
});

function editSidebarLink() {
	var currentLinkId;
	$(".editSidebarLink").on("click", function() {
		var link = $(this);
		var linkId = link.data().id;
		currentLinkId = linkId;
		var linkTitle = $("#title" + linkId).text();
		var linkAddress = $("#link" + linkId).text();
		var linkIsArchived = parseInt($("#isArchived" + linkId).text());
		$("#editSidebarLinkId").val(linkId);
		$("#editSidebarLinkTitle").val(linkTitle);
		$("#editSidebarLinkAddress").val(linkAddress);
		if(linkIsArchived === 0) {
			$("#editSidebarLinkIsNotArchived").prop("checked", true);
		} else {
			$("#editSidebarLinkIsArchived").prop("checked", true);
		}
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
					var newTitle = $("#editSidebarLinkTitle").val();
					var newLink = $("#editSidebarLinkAddress").val();
					var newIsArchived = $('input[name=editSidebarLinkIsArchived]').filter(':checked').val();
					$("#title" + currentLinkId).text(newTitle);
					$("#link" + currentLinkId).html("<a href=" + newLink + ">"+ newLink +"</a>");
					console.log(newIsArchived);
					$("#isArchived" + currentLinkId).text(newIsArchived);
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				//alert(currentLinkId);
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