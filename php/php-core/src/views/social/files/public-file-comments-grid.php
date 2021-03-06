<div role="main">
	<table class="table table-bordered" id="publicFilesTableComments">
		<tr class="label label-info">
			<th><strong>Comment</strong></th>
		</tr>
	</table>
</div>
          	
            <script type="text/javascript">
            require([ "sbt/connections/FileService", "sbt/dom" ], function(FileService, dom) {
            	var createRow = function(i) {
            		var table = dom.byId("publicFilesTableComments");
            		var tr = document.createElement("tr");
            		table.appendChild(tr);
            		var td = document.createElement("td");
            		td.setAttribute("id", "comment" + i);
            		tr.appendChild(td);
            	};

            	var fileService = new FileService();

            	fileService.getPublicFiles().then(function(files) {
            		if (files.length == 0) {
            			dom.setText("content", "Threre are no public files");
            		} else {
            			var file = files[0];
            			fileService.getPublicFileComments(file.getAuthor().authorUserId, file.getFileId()).then(function(comments) {
            				if (comments.length == 0) {
            					text = "There are no comments for this file.";
            				} else {
            					for ( var i = 0; i < comments.length; i++) {
            						var comment = comments[i];
            						createRow(i);
            						dom.setText("comment" + i, comment.getContent() + '\n\n (file: ' + file.getTitle() + ')');
            					}
            				}
            			}, function(error) {
            				console.log(error);
            			});
            		}
            	});

            });
				</script>            