<!-- Markup for Quote Form -->
<div id="quote_form_container">
	<form action="" name="quote_form" id="quote_form">
		
		<div id="name_container" class="form-field-container">
			<label for="name" id="name_label">Name</label>
			<input type="text" name="name" class="text-input" value="" />
		</div>
		
		<div id"email_container" class="form-field-container">
			<label for="email" id="email_label">Email</label>
			<input type="text" name="email" class="text-input" value="" />
		</div>
		
		<div id="zip_container" class="form-field-container">
			<label for="zip" id="zip_label">ZIP Code</label>
			<input type="text" name="zip" class="text-input" value="" />
		</div>
		
		<div id="quantity_container" class="form-field-container">
			<label for="quantity" id="quantity_label">Quantity</label>
			<input type="text" name="quantity" class="text-input" id="quantity" value="0" />
		</div>
		
		<div id="front_color_container" class="form-field-container">
			<label for="front_colors" id="front_colors_label"># of Front Colors</label>
			<input type="text" name="front_colors" class="text-input" id="front_colors" value="1" />
		</div>
		
		<div id="back_colors_container" class="form-field-container">
			<label for="back_colors" id="back_colors_label"># of Back Colors</label>
			<input type="text" name="back_colors" class="text-input" id="back_colors" value="0" />
		</div>
		
		<div id="sleeve_colors_container" class="form-field-container">
			<label for="sleeve_colors" id="back_colors_label"># of Sleeve Colors</label>
			<input type="text" name="sleeve_colors" class="text-input" id="sleeve_colors" value="0" />
		</div>
		
		<div id="shirt_type_container" class="form-field-container">
			<label for="shirt_type" id="shirt_type_label">Shirt Type</label>
			<select name="shirt_type" id="shirt_type"></select>
		</div>
		
		<div id="shirt_model_container" class="form-field-container">
			<label for="shirt_model" id="shirt_model_label">Shirt Model</label>
			<select name="shirt_model" id="shirt_model">
				
			</select>
		</div>
		
		<div id="shirt_color_container" class="form-field-container">
			<label for="shirt_color" id="shirt_color_label">Shirt Color</label>
			<select name="shirt_color" id="shirt_color"></select>
		</div>
		
		<div id="shirt_gender_container" class="form-field-container">
			<label for="shirt_gender" id="shirt_gender_label">Shirt Gender</label>
			<select name="shirt_gender" id="shirt_gender">
				
			</select>
		</div>
		
	</form>
	
	<div id="quote_button_container" class="form-field-container">
		<button onclick="getQuote()">get quote</button>
	</div>
	
</div>
<!-- END Quote Form Markup-->