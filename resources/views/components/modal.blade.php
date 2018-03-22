<div class="modal fade" id="{{ $id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					{{ $title }}
				</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ $content }}
			</div>
			<div class="modal-footer">
				{{ $footer }}
			</div>
		</div>
	</div>
</div>