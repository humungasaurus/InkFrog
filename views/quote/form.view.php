<!-- Markup for Quote Form -->
<div id="quote_form_container">
	<div id="form_wrapper"class="rounded-corners shadow">
		<h1>1. Complete the form:</h1>
		<form action="" name="quote_form" id="quote_form">
		
			<div id="name_container" class="form-field-container">
				<label for="name" id="name_label">Name</label>
				<input type="text" name="name" class="text-input" value="" id="name"/>
			</div>
		
			<div id"email_container" class="form-field-container">
				<label for="email" id="email_label">Email</label>
				<input type="text" name="email" class="text-input" value="" id="email"/>
			</div>
		
			<!--<div id="zip_container" class="form-field-container">
				<label for="zip" id="zip_label">ZIP Code</label>
				<input type="text" name="zip" class="text-input" value="" />
			</div>-->
		
			<div id="quantity_container" class="form-field-container">
				<label for="quantity" id="quantity_label">Quantity</label>
				<input type="text" name="quantity" class="text-input" id="quantity" value="12" />
			</div>
		
			<div id="color_container" class="form-field-container">
				<label for="front_colors" id="front_colors_label"># of Colors</label>
				<div class="styled-select narrow">
					<select name="front_colors" id="front_colors" class="color-selector select">
						<option value="">front</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
				</div>
				<div class="styled-select narrow">
					<select name="back_colors" id="back_colors" class="color-selector select">
						<option value="">back</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
				</div>
				<div class="styled-select narrow sleeve">
					<select name="sleeve_colors" id="sleeve_colors" class="color-selector sleeve select">
						<option value="">sleeve</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
				</div>
			</div>
		
			<!--<div id="front_color_container" class="form-field-container">
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
			</div>-->
		
			<div id="shirt_type_container" class="form-field-container">
				<label for="shirt_type" id="shirt_type_label">Shirt Type</label>
				<div class="styled-select">
					<select name="shirt_type" id="shirt_type" class="select"></select>
				</div>
			</div>
		
			<!--<div id="shirt_model_container" class="form-field-container">
				<label for="shirt_model" id="shirt_model_label">Shirt Model</label>
				<div class="styled-select">
					<select name="shirt_model" id="shirt_model"></select>
				</div>
			</div>-->
		
			<div id="shirt_color_container" class="form-field-container">
				<label for="shirt_color" id="shirt_color_label">Shirt Color</label>
				<div class="styled-select">
					<select name="shirt_color" id="shirt_color" class="select"></select>
				</div>
			</div>
			
			<div id="shirt_addon_container"></div>
		
			<!--<div id="shirt_gender_container" class="form-field-container">
				<label for="shirt_gender" id="shirt_gender_label">Shirt Gender</label>
				<select name="shirt_gender" id="shirt_gender"></select>
			</div>-->
		
		</form>
		<div id="quote_button_container" class="form-field-container">
			<button onclick="resetForm()" class="subtle_gradient shadow-light button">reset form</button>
			<button onclick="getQuote()" class="subtle_gradient shadow-light button">get quote</button>
		</div>
		
	</div>
	
	<div id="result_wrapper" class="rounded-corners shadow">
		<div id="quote_value_container">
			<h1>2. Get a quote:</h1>
			<ul>
				<li>Please complete the form to the left.</li>
			</ul>
		</div>
		<div id="quote_mailer_container">
			<button onclick="sendQuote()" class="subtle_gradient shadow-light">Please contact me about this quote!</button>
		</div>
	</div>
</div>
<!-- END Quote Form Markup-->