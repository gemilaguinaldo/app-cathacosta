<!-- NOTE: translate to VUE -->
<template>
	<div>
		<div id="alert-container" class="alert-container"></div>
		<div id="alert-template" class="d-none">
			<div class="alert-box">
			  <span class="alert-close" onclick="this.parentElement.style.display='none';">&times;</span>
			  <strong class="strong-msg"></strong> <span class="content-msg"></span>
			</div>
		</div>
	</div>

</template>

<script>
	export default {

		methods: {
			alertNotify(type, strong, content) {
				var container = $('#alert-container'),
					template = $('#alert-template').clone();
				template.removeClass('d-none')
						.removeAttr('id');
				template.find('.alert-box').addClass(type);
				template.find('.strong-msg').text(strong);
				template.find('.content-msg').text(content);
				template.hide()
			    	.fadeIn(1000)
			    	.fadeOut(8000);
				container.append(template);
			}
		}
	}
</script>