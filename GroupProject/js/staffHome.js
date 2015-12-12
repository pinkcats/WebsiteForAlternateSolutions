$(document).ready( function() {
	addSidebarLink();
	editSidebarLink();
	deleteSidebarLink();
	nameUpdate();
});

function nameUpdate(){
	// this must be added after the contactInfo is on the page
	// and can be edited
	// add a span where the welcome message is
	// var firstName = $("#firstName").val();
	// var lastName = $("#lastName").val();
	// jquery select the id and .text(firstName + " " + lastName);
};

function deleteSidebarLink() {
	$(document).on("click", ".deleteSidebarLink", function() {
		var link = $(this);
		var linkId = link.data().id;
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/deleteSidebarLinkController.php",
			data: {
				linkId: linkId
			},
			dataType: "json",
			success: function(response) {
				if(response.success){
					$("#title" + linkId).parent().addClass("danger").delay(250).fadeOut();
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
}

function editSidebarLink() {
	var currentLinkId;
	$(document).on("click", ".editSidebarLink", function() {
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
					$("#title" + currentLinkId).parent().addClass("success");
					$("#title" + currentLinkId).text(newTitle);
					$("#link" + currentLinkId).html("<a href=" + newLink + ">"+ newLink +"</a>");
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
					var newLink = response.newLink;
					var title = "<td id='title"+ newLink.id +"'>"+ newLink.title +"</td>";
					var linkAddress = "<td id='link"+ newLink.id +"'><a target='_blank' href='"+ newLink.link +"'>"+ newLink.link +"</a></td>";
					var isArchived = "<td id='isArchived"+ newLink.id +"'>"+ newLink.isArchived +"</td>";
					var editButton = "<td class='text-right'><button type='button' class='btn btn-default editSidebarLink' data-id='"+ newLink.id +"'>Edit</button></td>";;
					var deleteButton = "<td class='text-right'><button type='button' class='btn btn-default deleteSidebarLink' data-id='"+ newLink.id +"'>Delete</button></td>";
					$('#sidebarLinksTable > tbody').hide().prepend("<tr class='success'>" + title + "" + linkAddress + "" + isArchived + "" + editButton + "" + deleteButton + "</tr>").fadeIn("slow");
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