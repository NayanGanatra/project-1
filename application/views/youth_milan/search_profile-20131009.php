<style>
.headertable th, .headertable td
{
	width:24.5%;
}
.headertable th
{
	text-align:left;
}
</style>
<?php $this->load->view('youth_milan/layout/header'); ?>
<div class="photogallery">

	<div class="logo-text2">Search Profile</div>
	<!--updated by ketan 20130924-->	
	
	<table style="margin:auto; width:90%;" class="headertable" cellpadding="5">
	<tr>
		<th>Gender</th>
		<th>Criteria</th>
		</tr>
		<?php
                $form_attributes = array('id' => 'myform');
				
                echo form_open(base_url().'youth_milan/registration/search', $form_attributes);
    ?>
		<tr>
		<td class="txtBlack13Arial">
	
		<input type="radio" name="ym_gender" value="male"/>
		<span style="margin-left:2px;">Male</span><br />
		<input type="radio" name="ym_gender" value="female"/>
		<span style="margin-left:2px;">Female</span></td>
		
		<td colspan="2">
		<input type="radio" name="rdcriteria" checked="true" value="allcriteria"/>
		<span style="margin-left:2px;">Show profiles matching all the criteria</span><br />
		<input type="radio" name="rdcriteria" value='anycriteria'/>
		<span style="margin-left:2px;">Show profiles matching any of the criteria</span></td>
		</tr>
	<tr>
	<th>Marital Status</th>
	<th>Body Type</th>
	<th>Height</th>
	<th>Weight</th>
	</tr>
	
	<tr>
	
			<!--<select id="ym_gender" name="ym_gender" style="width:100%;">
                <option value="">Select</option>
                <option value="male">Male</option>
				<option value="female">Female</option>
			</select>-->
		
		<td class="txtBlack13Arial">
			<select id="ym_marital_status" name="ym_marital_status" style="width:100%;">
                <option value="">Select</option>
                <option value="Unmarried">Unmarried</option>
				<option value="Divorcee">Divorcee</option>
				<option value="Widow">Widow/Widower</option>
				<option value="Separated">Separated</option>
			</select>
		</td>
		<td class="txtBlack13Arial">
			<select id="ym_body_type" name="ym_body_type" style="width:100%;">
                <option value="">Select</option>
                <option value="Athletic">Athletic</option>
				<option value="Average">Average</option>
				<option value="Chubby">Chubby</option>
				<option value="Heavy">Heavy</option>
				<option value="Slim">Slim</option>
			</select>
		</td>
		<td class="txtBlack13Arial">
			<select id="ym_height_start" name="ym_height_start" style="width:49%;">
                <option value="">From</option>
                <option value="121">4 ft 0 in/121cms</option>
				<option value="124">4 ft 1 in/124cms</option>
				<option value="127">4 ft 2 in/127cms</option>
				<option value="129">4 ft 3 in/129cms</option>
				<option value="132">4 ft 4 in/132cms</option>
				<option value="134">4 ft 5 in/134cms</option>
				<option value="137">4 ft 6 in/137cms</option>
				<option value="139">4 ft 7 in/139cms</option>
				<option value="142">4 ft 8 in/142cms</option>
				<option value="144">4 ft 9 in/144cms</option>
				<option value="147">4 ft 10 in/147cms</option>
				<option value="149">4 ft 11 in/149cms</option>
				<option value="152">5 ft 0 in/152cms</option>
				<option value="154">5 ft 1 in/154cms</option>
				<option value="157">5 ft 2 in/157cms</option>
				<option value="160">5 ft 3 in/160cms</option>
				<option value="162">5 ft 4 in/162cms</option>
				<option value="165">5 ft 5 in/165cms</option>
				<option value="167">5 ft 6 in/167cms</option>
				<option value="170">5 ft 7 in/170cms</option>
				<option value="172">5 ft 8 in/172cms</option>
				<option value="175">5 ft 9 in/175cms</option>
				<option value="177">5 ft 10 in/177cms</option>
				<option value="180">5 ft 11 in/180cms</option>
				<option value="182">6 ft 0 in/182cms</option>
				<option value="185">6 ft 1 in/185cms</option>
				<option value="187">6 ft 2 in/187cms</option>
				<option value="190">6 ft 3 in/190cms</option>
				<option value="193">6 ft 4 in/193cms</option>
				<option value="195">6 ft 5 in/195cms</option>
				<option value="198">6 ft 6 in/198cms</option>
				<option value="200">6 ft 7 in/200cms</option>
				<option value="203">6 ft 8 in/203cms</option>
				<option value="205">6 ft 9 in/205cms</option>
				<option value="208">6 ft 10 in/208cms</option>
				<option value="210">6 ft 11 in/210cms</option>
				<option value="213">7 ft 0 in/213cms</option>
            </select>
			<select id="ym_height_end" name="ym_height_end" style="width:49%;">
                <option value="">To</option>
                <option value="121">4 ft 0 in/121cms</option>
				<option value="124">4 ft 1 in/124cms</option>
				<option value="127">4 ft 2 in/127cms</option>
				<option value="129">4 ft 3 in/129cms</option>
				<option value="132">4 ft 4 in/132cms</option>
				<option value="134">4 ft 5 in/134cms</option>
				<option value="137">4 ft 6 in/137cms</option>
				<option value="139">4 ft 7 in/139cms</option>
				<option value="142">4 ft 8 in/142cms</option>
				<option value="144">4 ft 9 in/144cms</option>
				<option value="147">4 ft 10 in/147cms</option>
				<option value="149">4 ft 11 in/149cms</option>
				<option value="152">5 ft 0 in/152cms</option>
				<option value="154">5 ft 1 in/154cms</option>
				<option value="157">5 ft 2 in/157cms</option>
				<option value="160">5 ft 3 in/160cms</option>
				<option value="162">5 ft 4 in/162cms</option>
				<option value="165">5 ft 5 in/165cms</option>
				<option value="167">5 ft 6 in/167cms</option>
				<option value="170">5 ft 7 in/170cms</option>
				<option value="172">5 ft 8 in/172cms</option>
				<option value="175">5 ft 9 in/175cms</option>
				<option value="177">5 ft 10 in/177cms</option>
				<option value="180">5 ft 11 in/180cms</option>
				<option value="182">6 ft 0 in/182cms</option>
				<option value="185">6 ft 1 in/185cms</option>
				<option value="187">6 ft 2 in/187cms</option>
				<option value="190">6 ft 3 in/190cms</option>
				<option value="193">6 ft 4 in/193cms</option>
				<option value="195">6 ft 5 in/195cms</option>
				<option value="198">6 ft 6 in/198cms</option>
				<option value="200">6 ft 7 in/200cms</option>
				<option value="203">6 ft 8 in/203cms</option>
				<option value="205">6 ft 9 in/205cms</option>
				<option value="208">6 ft 10 in/208cms</option>
				<option value="210">6 ft 11 in/210cms</option>
				<option value="213">7 ft 0 in/213cms</option>
            </select>
		</td>
		<td class="txtBlack13Arial">
								
			<select id="ym_weight_start" name="ym_weight_start" style="width:49%;">
                <option value="">From</option>
               	<option value="40" >40 kgs/ 88 lbs</option>
				<option value="41">41 kgs/ 90 lbs</option>
				<option value="42">42 kgs/ 92 lbs</option>
				<option value="43">43 kgs/ 94 lbs</option>
				<option value="44">44 kgs/ 97 lbs</option>
				<option value="45">45 kgs/ 99 lbs</option>
				<option value="46">46 kgs/ 101 lbs</option>
				<option value="47">47 kgs/ 103 lbs</option>
				<option value="48">48 kgs/ 105 lbs</option>
				<option value="49">49 kgs/ 108 lbs</option>
				<option value="50">50 kgs/ 110 lbs</option>
				<option value="51">51 kgs/ 112 lbs</option>
				<option value="52">52 kgs/ 114 lbs</option>
				<option value="53">53 kgs/ 116 lbs</option>
				<option value="54">54 kgs/ 119 lbs</option>
				<option value="55">55 kgs/ 121 lbs</option>
				<option value="56">56 kgs/ 123 lbs</option>
				<option value="57">57 kgs/ 125 lbs</option>
				<option value="58">58 kgs/ 127 lbs</option>
				<option value="59">59 kgs/ 130 lbs</option>
				<option value="60">60 kgs/ 132 lbs</option>
				<option value="61">61 kgs/ 134 lbs</option>
				<option value="62">62 kgs/ 136 lbs</option>
				<option value="63">63 kgs/ 138 lbs</option>
				<option value="64">64 kgs/ 141 lbs</option>
				<option value="65">65 kgs/ 143 lbs</option>
				<option value="66">66 kgs/ 145 lbs</option>
				<option value="67">67 kgs/ 147 lbs</option>
				<option value="68">68 kgs/ 149 lbs</option>
				<option value="69">69 kgs/ 152 lbs</option>
				<option value="70">70 kgs/ 154 lbs</option>
				<option value="71">71 kgs/ 156 lbs</option>
				<option value="72">72 kgs/ 158 lbs</option>
				<option value="73">73 kgs/ 160 lbs</option>
				<option value="74">74 kgs/ 163 lbs</option>
				<option value="75">75 kgs/ 165 lbs</option>
				<option value="76">76 kgs/ 167 lbs</option>
				<option value="77">77 kgs/ 169 lbs</option>
				<option value="78">78 kgs/ 171 lbs</option>
				<option value="79">79 kgs/ 174 lbs</option>
				<option value="80">80 kgs/ 176 lbs</option>
				<option value="81">81 kgs/ 178 lbs</option>
				<option value="82">82 kgs/ 180 lbs</option>
				<option value="83">83 kgs/ 182 lbs</option>
				<option value="84">84 kgs/ 185 lbs</option>
				<option value="85">85 kgs/ 187 lbs</option>
				<option value="86">86 kgs/ 189 lbs</option>
				<option value="87">87 kgs/ 191 lbs</option>
				<option value="88">88 kgs/ 194 lbs</option>
				<option value="89">89 kgs/ 196 lbs</option>
				<option value="90">90 kgs/ 198 lbs</option>
				<option value="91">91 kgs/ 200 lbs</option>
				<option value="92">92 kgs/ 202 lbs</option>
				<option value="93">93 kgs/ 205 lbs</option>
				<option value="94">94 kgs/ 207 lbs</option>
				<option value="95">95 kgs/ 209 lbs</option>
				<option value="96">96 kgs/ 211 lbs</option>
				<option value="97">97 kgs/ 213 lbs</option>
				<option value="98">98 kgs/ 216 lbs</option>
				<option value="99">99 kgs/ 218 lbs</option>
				<option value="100">100 kgs/ 220 lbs</option>
				<option value="101">101 kgs/ 222 lbs</option>
				<option value="102">102 kgs/ 224 lbs</option>
				<option value="103">103 kgs/ 227 lbs</option>
				<option value="104">104 kgs/ 229 lbs</option>
				<option value="105">105 kgs/ 231 lbs</option>
				<option value="106">106 kgs/ 233 lbs</option>
				<option value="107">107 kgs/ 235 lbs</option>
				<option value="108">108 kgs/ 238 lbs</option>
				<option value="109">109 kgs/ 240 lbs</option>
				<option value="110">110 kgs/ 242 lbs</option>
				<option value="111">111 kgs/ 244 lbs</option>
				<option value="112">112 kgs/ 246 lbs</option>
				<option value="113">113 kgs/ 249 lbs</option>
				<option value="114">114 kgs/ 251 lbs</option>
				<option value="115">115 kgs/ 253 lbs</option>
				<option value="116">116 kgs/ 255 lbs</option>
				<option value="117">117 kgs/ 257 lbs</option>
				<option value="118">118 kgs/ 260 lbs</option>
				<option value="119">119 kgs/ 262 lbs</option>
				<option value="120">120 kgs/ 264 lbs</option>
				<option value="121">121 kgs/ 266 lbs</option>
				<option value="122">122 kgs/ 268 lbs</option>
				<option value="123">123 kgs/ 271 lbs</option>
				<option value="124">124 kgs/ 273 lbs</option>
				<option value="125">125 kgs/ 275 lbs</option>
				<option value="126">126 kgs/ 277 lbs</option>
				<option value="127">127 kgs/ 279 lbs</option>
				<option value="128">128 kgs/ 282 lbs</option>
				<option value="129">129 kgs/ 284 lbs</option>
				<option value="130">130 kgs/ 286 lbs</option>
				<option value="131">131 kgs/ 288 lbs</option>
				<option value="132">132 kgs/ 291 lbs</option>
				<option value="133">133 kgs/ 293 lbs</option>
				<option value="134">134 kgs/ 295 lbs</option>
				<option value="135">135 kgs/ 297 lbs</option>
				<option value="136">136 kgs/ 299 lbs</option>
				<option value="137">137 kgs/ 302 lbs</option>
				<option value="138">138 kgs/ 304 lbs</option>
				<option value="139">139 kgs/ 306 lbs</option>
				<option value="140">140 kgs/ 308 lbs</option>
				<option value="141">141 kgs/ 310 lbs</option>
				<option value="142">142 kgs/ 313 lbs</option>
				<option value="143">143 kgs/ 315 lbs</option>
				<option value="144">144 kgs/ 317 lbs</option>
				<option value="145">145 kgs/ 319 lbs</option>
				<option value="146">146 kgs/ 321 lbs</option>
				<option value="147">147 kgs/ 324 lbs</option>
				<option value="148">148 kgs/ 326 lbs</option>
				<option value="149">149 kgs/ 328 lbs</option>
				<option value="150">150 kgs/ 330 lbs</option>
            </select>
			<select id="ym_weight_end" name="ym_weight_end" style="width:49%;">
                <option value="">To</option>
               	<option value="40" >40 kgs/ 88 lbs</option>
				<option value="41">41 kgs/ 90 lbs</option>
				<option value="42">42 kgs/ 92 lbs</option>
				<option value="43">43 kgs/ 94 lbs</option>
				<option value="44">44 kgs/ 97 lbs</option>
				<option value="45">45 kgs/ 99 lbs</option>
				<option value="46">46 kgs/ 101 lbs</option>
				<option value="47">47 kgs/ 103 lbs</option>
				<option value="48">48 kgs/ 105 lbs</option>
				<option value="49">49 kgs/ 108 lbs</option>
				<option value="50">50 kgs/ 110 lbs</option>
				<option value="51">51 kgs/ 112 lbs</option>
				<option value="52">52 kgs/ 114 lbs</option>
				<option value="53">53 kgs/ 116 lbs</option>
				<option value="54">54 kgs/ 119 lbs</option>
				<option value="55">55 kgs/ 121 lbs</option>
				<option value="56">56 kgs/ 123 lbs</option>
				<option value="57">57 kgs/ 125 lbs</option>
				<option value="58">58 kgs/ 127 lbs</option>
				<option value="59">59 kgs/ 130 lbs</option>
				<option value="60">60 kgs/ 132 lbs</option>
				<option value="61">61 kgs/ 134 lbs</option>
				<option value="62">62 kgs/ 136 lbs</option>
				<option value="63">63 kgs/ 138 lbs</option>
				<option value="64">64 kgs/ 141 lbs</option>
				<option value="65">65 kgs/ 143 lbs</option>
				<option value="66">66 kgs/ 145 lbs</option>
				<option value="67">67 kgs/ 147 lbs</option>
				<option value="68">68 kgs/ 149 lbs</option>
				<option value="69">69 kgs/ 152 lbs</option>
				<option value="70">70 kgs/ 154 lbs</option>
				<option value="71">71 kgs/ 156 lbs</option>
				<option value="72">72 kgs/ 158 lbs</option>
				<option value="73">73 kgs/ 160 lbs</option>
				<option value="74">74 kgs/ 163 lbs</option>
				<option value="75">75 kgs/ 165 lbs</option>
				<option value="76">76 kgs/ 167 lbs</option>
				<option value="77">77 kgs/ 169 lbs</option>
				<option value="78">78 kgs/ 171 lbs</option>
				<option value="79">79 kgs/ 174 lbs</option>
				<option value="80">80 kgs/ 176 lbs</option>
				<option value="81">81 kgs/ 178 lbs</option>
				<option value="82">82 kgs/ 180 lbs</option>
				<option value="83">83 kgs/ 182 lbs</option>
				<option value="84">84 kgs/ 185 lbs</option>
				<option value="85">85 kgs/ 187 lbs</option>
				<option value="86">86 kgs/ 189 lbs</option>
				<option value="87">87 kgs/ 191 lbs</option>
				<option value="88">88 kgs/ 194 lbs</option>
				<option value="89">89 kgs/ 196 lbs</option>
				<option value="90">90 kgs/ 198 lbs</option>
				<option value="91">91 kgs/ 200 lbs</option>
				<option value="92">92 kgs/ 202 lbs</option>
				<option value="93">93 kgs/ 205 lbs</option>
				<option value="94">94 kgs/ 207 lbs</option>
				<option value="95">95 kgs/ 209 lbs</option>
				<option value="96">96 kgs/ 211 lbs</option>
				<option value="97">97 kgs/ 213 lbs</option>
				<option value="98">98 kgs/ 216 lbs</option>
				<option value="99">99 kgs/ 218 lbs</option>
				<option value="100">100 kgs/ 220 lbs</option>
				<option value="101">101 kgs/ 222 lbs</option>
				<option value="102">102 kgs/ 224 lbs</option>
				<option value="103">103 kgs/ 227 lbs</option>
				<option value="104">104 kgs/ 229 lbs</option>
				<option value="105">105 kgs/ 231 lbs</option>
				<option value="106">106 kgs/ 233 lbs</option>
				<option value="107">107 kgs/ 235 lbs</option>
				<option value="108">108 kgs/ 238 lbs</option>
				<option value="109">109 kgs/ 240 lbs</option>
				<option value="110">110 kgs/ 242 lbs</option>
				<option value="111">111 kgs/ 244 lbs</option>
				<option value="112">112 kgs/ 246 lbs</option>
				<option value="113">113 kgs/ 249 lbs</option>
				<option value="114">114 kgs/ 251 lbs</option>
				<option value="115">115 kgs/ 253 lbs</option>
				<option value="116">116 kgs/ 255 lbs</option>
				<option value="117">117 kgs/ 257 lbs</option>
				<option value="118">118 kgs/ 260 lbs</option>
				<option value="119">119 kgs/ 262 lbs</option>
				<option value="120">120 kgs/ 264 lbs</option>
				<option value="121">121 kgs/ 266 lbs</option>
				<option value="122">122 kgs/ 268 lbs</option>
				<option value="123">123 kgs/ 271 lbs</option>
				<option value="124">124 kgs/ 273 lbs</option>
				<option value="125">125 kgs/ 275 lbs</option>
				<option value="126">126 kgs/ 277 lbs</option>
				<option value="127">127 kgs/ 279 lbs</option>
				<option value="128">128 kgs/ 282 lbs</option>
				<option value="129">129 kgs/ 284 lbs</option>
				<option value="130">130 kgs/ 286 lbs</option>
				<option value="131">131 kgs/ 288 lbs</option>
				<option value="132">132 kgs/ 291 lbs</option>
				<option value="133">133 kgs/ 293 lbs</option>
				<option value="134">134 kgs/ 295 lbs</option>
				<option value="135">135 kgs/ 297 lbs</option>
				<option value="136">136 kgs/ 299 lbs</option>
				<option value="137">137 kgs/ 302 lbs</option>
				<option value="138">138 kgs/ 304 lbs</option>
				<option value="139">139 kgs/ 306 lbs</option>
				<option value="140">140 kgs/ 308 lbs</option>
				<option value="141">141 kgs/ 310 lbs</option>
				<option value="142">142 kgs/ 313 lbs</option>
				<option value="143">143 kgs/ 315 lbs</option>
				<option value="144">144 kgs/ 317 lbs</option>
				<option value="145">145 kgs/ 319 lbs</option>
				<option value="146">146 kgs/ 321 lbs</option>
				<option value="147">147 kgs/ 324 lbs</option>
				<option value="148">148 kgs/ 326 lbs</option>
				<option value="149">149 kgs/ 328 lbs</option>
				<option value="150">150 kgs/ 330 lbs</option>
            </select>
			</td>
	</tr>
	<tr>
	
	
	<th>Religion</th>
	<th>Cast</th>
	<th>Sub Cast</th>
	<th>Name</th>
	</tr>
	<tr>
	
		
								<td class="txtBlack13Arial">
                   		<select class="combo" id="ym_community" name="ym_community" style="width:100%;">
                            <option value="">Select</option>
							<option value="Atheist">Atheist</option>
							<option value="Buddhist">Buddhist</option>
							<option value="Caste No Bar">Caste No Bar</option>
							<option value="Christian">Christian</option>
							<option value="Hindu">Hindu</option>
							<option value="Inter Religion">Inter Religion</option>
							<option value="Jain">Jain</option>
							<option value="Jewish">Jewish</option>
							<option value="Jews">Jews</option>
							<option value="Muslim">Muslim</option>
							<option value="No Religion">No Religion</option>
							<option value="Other">Other</option>
							<option value="Parsi">Parsi</option>
							<option value="Sikh">Sikh</option>
					    </select>
                   </td>
	
	
	
	<td class="txtBlack13Arial">
		<select  class="combo" id="ym_caste" name="ym_caste" style="width:100%;">
	        <option value="">Select</option>
			<option value="Ad Dharmi">Ad Dharmi</option>
			<option value="Adi Dravida">Adi Dravida</option>
			<option value="Aggarwal">Aggarwal</option>
			<option value="Agnikula Kshatriya">Agnikula Kshatriya</option>
			<option value="Agri">Agri</option>
			<option value="Ahom">Ahom</option>
			<option value="Ambalavasi">Ambalavasi</option>
			<option value="Anglicans">Anglicans</option>
			<option value="Ansari">Ansari</option>
			<option value="Arain">Arain</option>
			<option value="Arunthathiyar">Arunthathiyar</option>
			<option value="Arya Vysya">Arya Vysya</option>
			<option value="Aryasamaj">Aryasamaj</option>
			<option value="Awan">Awan</option>
			<option value="Baghel/Pal/Gaderiya">Baghel/Pal/Gaderiya</option>
			<option value="Bahi">Bahi</option>
			<option value="Baidya">Baidya</option>
			<option value="Baishnab">Baishnab</option>
			<option value="Baishya">Baishya</option>
			<option value="Balija">Balija</option>
			<option value="Balija Naidu">Balija Naidu</option>
			<option value="Bania">Bania</option>
			<option value="Banik">Banik</option>
			<option value="Bari">Bari</option> 
			<option value="Barujibi">Barujibi</option>
			<option value="Bengali">Bengali</option>
			<option value="Besta">Besta</option>
			<option value="Bhandari">Bhandari</option>
			<option value="Bhatia">Bhatia</option>
			<option value="Bhavasar Kshatriya">Bhavasar Kshatriya</option>
			<option value="Bhavsar">Bhavsar</option>
			<option value="Bhovi">Bhovi</option>
			<option value="Billava">Billava</option>
			<option value="Bohra">Bohra</option>
			<option value="Born Again">Born Again</option>
			<option value="Boyer">Boyer</option>
			<option value="Brahmbatt">Brahmbatt</option>
			<option value="Brahmin">Brahmin</option>
			<option value="Brahmin 6000 Niyogi">Brahmin 6000 Niyogi</option>
			<option value="Brahmin 96K Kokanastha">Brahmin 96K Kokanastha</option>
			<option value="Brahmin Anavil">Brahmin Anavil</option>
			<option value="Brahmin Audichya">Brahmin Audichya</option>
			<option value="Brahmin Barendra">Brahmin Barendra</option>
			<option value="Brahmin Bengali">Brahmin Bengali</option>
			<option value="Brahmin Bhatt">Brahmin Bhatt</option>
			<option value="Brahmin Bhumihar">Brahmin Bhumihar</option>
			<option value="Brahmin Daivadnya">Brahmin Daivadnya</option>
			<option value="Brahmin Danua">Brahmin Danua</option>
			<option value="Brahmin Deshastha">Brahmin Deshastha</option>
			<option value="Brahmin Dhiman">Brahmin Dhiman</option>
			<option value="Brahmin Divajna">Brahmin Divajna</option>
			<option value="Brahmin Dravida">Brahmin Dravida</option>
			<option value="Brahmin Garhwali">Brahmin Garhwali</option>
			<option value="Brahmin Gaud Saraswat (GSB)">Brahmin Gaud Saraswat (GSB)</option>
			<option value="Brahmin Gaur">Brahmin Gaur</option>
			<option value="Brahmin Goswami">Brahmin Goswami</option>
			<option value="Brahmin Gurukkal">Brahmin Gurukkal</option>
			<option value="Brahmin Halua">Brahmin Halua</option>
			<option value="Brahmin Havyaka">Brahmin Havyaka</option>
			<option value="Brahmin Hoysala">Brahmin Hoysala</option>
			<option value="Brahmin Iyengar">Brahmin Iyengar</option>
			<option value="Brahmin Iyer">Brahmin Iyer</option>
			<option value="Brahmin Jhadua">Brahmin Jhadua</option>
			<option value="Brahmin Kanada Madhva">Brahmin Kanada Madhva</option>
			<option value="Brahmin Kanyakubj">Brahmin Kanyakubj</option>
			<option value="Brahmin Karhade">Brahmin Karhade</option>
			<option value="Brahmin Kashmiri Pandit">Brahmin Kashmiri Pandit</option>
			<option value="Brahmin Koknastha">Brahmin Koknastha</option>
			<option value="Brahmin Kota">Brahmin Kota</option>
			<option value="Brahmin Kulin">Brahmin Kulin</option>
			<option value="Brahmin Kumaoni">Brahmin Kumaoni</option>
			<option value="Brahmin Madhwa">Brahmin Madhwa</option>
			<option value="Brahmin Maharashtrian">Brahmin Maharashtrian</option>
			<option value="Brahmin Maithil">Brahmin Maithil</option>
			<option value="Brahmin Modh">Brahmin Modh</option>
			<option value="Brahmin Mohyal">Brahmin Mohyal</option>
			<option value="Brahmin Nagar">Brahmin Nagar</option>
			<option value="Brahmin Namboodiri">Brahmin Namboodiri</option>
			<option value="Brahmin Narmadiya">Brahmin Narmadiya</option>
			<option value="Brahmin Niyogi">Brahmin Niyogi</option>
			<option value="Brahmin Niyogi Nandavariki">Brahmin Niyogi Nandavariki</option>
			<option value="Brahmin Panda">Brahmin Panda</option>
			<option value="Brahmin Pandit">Brahmin Pandit</option>
			<option value="Brahmin Punjabi">Brahmin Punjabi</option>
			<option value="Brahmin Pushkarna">Brahmin Pushkarna</option>
			<option value="Brahmin Rarhi">Brahmin Rarhi</option>
			<option value="Brahmin Rigvedi">Brahmin Rigvedi</option>
			<option value="Brahmin Rudraj">Brahmin Rudraj</option>
			<option value="Brahmin Sakaldwipi">Brahmin Sakaldwipi</option>
			<option value="Brahmin Sanadya">Brahmin Sanadya</option>
			<option value="Brahmin Sanketi">Brahmin Sanketi</option>
			<option value="Brahmin Saraswat">Brahmin Saraswat</option>
			<option value="Brahmin Saryuparin">Brahmin Saryuparin</option>
			<option value="Brahmin Shivhalli">Brahmin Shivhalli</option>
			<option value="Brahmin Shrimali">Brahmin Shrimali</option>
			<option value="Brahmin Smartha">Brahmin Smartha</option>
			<option value="Brahmin Sri Vishnava">Brahmin Sri Vishnava</option>
			<option value="Brahmin Stanika">Brahmin Stanika</option>
			<option value="Brahmin Telugu">Brahmin Telugu</option>
			<option value="Brahmin Tyagi">Brahmin Tyagi</option>
			<option value="Brahmin Vaidiki">Brahmin Vaidiki</option>
			<option value="Brahmin Viswa">Brahmin Viswa</option>
			<option value="Brahmin Vyas">Brahmin Vyas</option>
			<option value="Bretheren">Bretheren</option>
			<option value="Buddhists">Buddhists</option>
			<option value="Bunt">Bunt</option>
			<option value="Caste No Bar">Caste No Bar</option>
			<option value="Catholic">Catholic</option>
			<option value="Chaddo">Chaddo</option>
			<option value="Chamar">Chamar</option>
			<option value="Chambhar">Chambhar</option>
			<option value="Chandravanshi Kahar">Chandravanshi Kahar</option>
			<option value="Chasa">Chasa</option>
			<option value="Chaudary">Chaudary</option>
			<option value="Chaurasia">Chaurasia</option>
			<option value="Chettiar">Chettiar</option>
			<option value="Chhetri">Chhetri</option>
			<option value="Church of South India (CSI)">Church of South India (CSI)</option>
			<option value="CKP">CKP</option>
			<option value="CMS">CMS</option>
			<option value="Coorgi">Coorgi</option>
			<option value="Dawoodi bohra">Dawoodi bohra</option>
			<option value="Dekkani">Dekkani</option>
			<option value="Devadigas">Devadigas</option>
			<option value="Devandra Kula Vellalar">Devandra Kula Vellalar</option>
			<option value="Devang Koshthi">Devang Koshthi</option>
			<option value="Devanga">Devanga</option>
			<option value="Dhaneshawat Vaish">Dhaneshawat Vaish</option>
			<option value="Dhangar">Dhangar</option>
			<option value="Dheevara">Dheevara</option>
			<option value="Dhiman">Dhiman</option>
			<option value="Dhoba">Dhoba</option>
			<option value="Dhobi">Dhobi</option>
			<option value="Digamber">Digamber</option>
			<option value="Dudekula">Dudekula</option>
			<option value="Edigas">Edigas</option>
			<option value="Ehle-Hadith">Ehle-Hadith</option>
			<option value="Evangelist">Evangelist</option>
			<option value="Ezhava">Ezhava</option>
			<option value="Ezhuthachan">Ezhuthachan</option>
			<option value="Gabit">Gabit</option>
			<option value="Gandla">Gandla</option>
			<option value="Ganiga">Ganiga</option>
			<option value="Ganigashetty">Ganigashetty</option>
			<option value="Garhwali">Garhwali</option>
			<option value="Gavara"></option>
			<option value="Gavdi">Gavdi</option>
			<option value="Ghumar">Ghumar</option>
			<option value="Goala">Goala</option>
			<option value="Goan">Goan</option>
			<option value="Gomantak Maratha">Gomantak Maratha</option>
			<option value="Goswami">Goswami</option>
			<option value="Goud">Goud</option>
			<option value="Gounder">Gounder</option>
			<option value="Gowda">Gowda</option>
			<option value="Gudia">Gudia</option>
			<option value="Gujjar">Gujjar</option>
			<option value="Gupta">Gupta</option>
			<option value="Hanafi">Hanafi</option>
			<option value="Hegde">Hegde</option>
			<option value="Hindu: Arora">Hindu: Arora</option>
			<option value="Hulsavar">Hulsavar</option>
			<option value="Indian Orthodox">Indian Orthodox</option>
			<option value="Intercaste">Intercaste</option>
			<option value="Irani">Irani</option>
			<option value="Iyengar">Iyengar</option>
			<option value="Iyer">Iyer</option>
			<option value="Jacobite">Jacobite</option>
			<option value="Jain Agarwal">Jain Agarwal</option>
			<option value="Jain Bania">Jain Bania</option>
			<option value="Jain Intercaste">Jain Intercaste</option>
			<option value="Jain Jaiswal">Jain Jaiswal</option>
			<option value="Jain Khandelwal">Jain Khandelwal</option>
			<option value="Jain Kutchi">Jain Kutchi</option>
			<option value="Jain No Bar">Jain No Bar</option>
			<option value="Jain Oswal">Jain Oswal</option>
			<option value="Jain Others">Jain Others</option>
			<option value="Jain Porwal">Jain Porwal</option>
			<option value="Jain Unspecified">Jain Unspecified</option>
			<option value="Jain Vaishya">Jain Vaishya</option>
			<option value="Jain Vania">Jain Vania</option>
			<option value="Jaiswal">Jaiswal</option>
			<option value="Jangam">Jangam</option>
			<option value="Jat">Jat</option>
			<option value="Jatav">Jatav</option>
			<option value="Jews Dawoodi Bohra">Jews Dawoodi Bohra</option>
			<option value="Jews Intercaste">Jews Intercaste</option>
			<option value="Jews No Bar">Jews No Bar</option>
			<option value="Jews Unspecified">Jews Unspecified</option>
			<option value="Kadava Patel">Kadava Patel</option>
			<option value="Kaibarta">Kaibarta</option>
			<option value="Kalar">Kalar</option>
			<option value="Kalavanthi">Kalavanthi</option>
			<option value="Kalinga">Kalinga</option>
			<option value="Kalinga Vysya">Kalinga Vysya</option>
			<option value="Kalita">Kalita</option>
			<option value="Kalwar">Kalwar</option>
			<option value="Kamboj">Kamboj</option>
			<option value="Kamma">Kamma</option>
			<option value="Kannada Mogaveera">Kannada Mogaveera</option>
			<option value="Kansari">Kansari</option>
			<option value="Kapu">Kapu</option>
			<option value="Kapu Mannuru">Kapu Mannuru</option>
			<option value="Kapu Naidu">Kapu Naidu</option>
			<option value="Karana">Karana</option>
			<option value="Karmakar">Karmakar</option>
			<option value="Karuneegar">Karuneegar</option>
			<option value="Kasar">Kasar</option>
			<option value="Kashyap">Kashyap</option>
			<option value="Kayastha">Kayastha</option>
			<option value="Khandayat">Khandayat</option>
			<option value="Khandelwal">Khandelwal</option>
			<option value="Kharve">Kharve</option>
			<option value="Khatik">Khatik</option>
			<option value="Khatri">Khatri</option>
			<option value="Khoja">Khoja</option>
			<option value="Knanaya">Knanaya</option>
			<option value="Knanaya Catholic">Knanaya Catholic</option>
			<option value="Knanaya Jacobite">Knanaya Jacobite</option>
			<option value="Koli">Koli</option>
			<option value="Kongu Vellala Gounder">Kongu Vellala Gounder</option>
			<option value="Konkani">Konkani</option>
			<option value="Kori">Kori</option>
			<option value="Koshti">Koshti</option>
			<option value="Kshatriya">Kshatriya</option>
			<option value="Kudumbi">Kudumbi</option>
			<option value="Kulal">Kulal</option>
			<option value="Kulalar">Kulalar</option>
			<option value="Kulita">Kulita</option>
			<option value="Kumawat">Kumawat</option>
			<option value="Kumbhakar">Kumbhakar</option>
			<option value="Kumbhar">Kumbhar</option>
			<option value="Kumhar">Kumhar</option>
			<option value="Kummari">Kummari</option>
			<option value="Kunbi">Kunbi</option>
			<option value="Kurmi">Kurmi</option>
			<option value="Kurmi Kshatriya">Kurmi Kshatriya</option>
			<option value="Kuruba">Kuruba</option>
			<option value="Kuruhina Shetty">Kuruhina Shetty</option>
			<option value="Kurumbar">Kurumbar</option>
			<option value="Kushwaha">Kushwaha</option>
			<option value="Kutchi">Kutchi</option>
			<option value="Lambadi">Lambadi</option>
			<option value="Latin Catholic">Latin Catholic</option>
			<option value="Lebbai">Lebbai</option>
			<option value="Leva patel">Leva patel</option>
			<option value="Leva Patidar">Leva Patidar</option>
			<option value="Leva patil">Leva patil</option>
			<option value="Lingayat">Lingayat</option>
			<option value="Lohana">Lohana</option>
			<option value="Lubana">Lubana</option>
			<option value="Madiga">Madiga</option>
			<option value="Madival">Madival</option>
			<option value="Mahajan">Mahajan</option>
			<option value="Mahar">Mahar</option>
			<option value="Mahendra">Mahendra</option>
			<option value="Maheshwari">Maheshwari</option>
			<option value="Mahishya">Mahishya</option>
			<option value="Majabi">Majabi</option>
			<option value="Mala">Mala</option>
			<option value="Malankara">Malankara</option>
			<option value="Malayalee Namboodiri">Malayalee Namboodiri</option>
			<option value="Malayalee Variar">Malayalee Variar</option>
			<option value="Mali">Mali</option>
			<option value="Malik">Malik</option>
			<option value="Malla">Malla</option>
			<option value="Mangalorean">Mangalorean</option>
			<option value="Mangalorean">Mangalorean</option>
			<option value="Manipuri">Manipuri</option>
			<option value="Mapila">Mapila</option>
			<option value="Maraicar">Maraicar</option>
			<option value="Maratha">Maratha</option>
			<option value="Marthoma">Marthoma</option>
			<option value="Maruthuvar">Maruthuvar</option>
			<option value="Marvar">Marvar</option>
			<option value="Marwari">Marwari</option>
			<option value="Matang">Matang</option>
			<option value="Maurya">Maurya</option>
			<option value="Meena">Meena</option>
			<option value="Meenavar">Meenavar</option>
			<option value="Mehra">Mehra</option>
			<option value="Memon">Memon</option>
			<option value="Menon">Menon</option>
			<option value="Meru">Meru</option>
			<option value="Meru Darji">Meru Darji</option>
			<option value="Mochi">Mochi</option>
			<option value="Modak">Modak</option>
			<option value="Mogaveera">Mogaveera</option>
			<option value="Monchi">Monchi</option>
			<option value="Moopanar">Moopanar</option>
			<option value="Mudaliar Arcot">Mudaliar Arcot</option>
			<option value="Mudaliar Saiva">Mudaliar Saiva</option>
			<option value="Mudaliar Senguntha">Mudaliar Senguntha</option>
			<option value="Mudaliyar">Mudaliyar</option>
			<option value="Mudiraj">Mudiraj</option>
			<option value="Mughal">Mughal</option>
			<option value="Mukkulathor">Mukkulathor</option>
			<option value="Muthuraja">Muthuraja</option>
			<option value="Nadar">Nadar</option>
			<option value="Nai">Nai</option>
			<option value="Naicker">Naicker</option>
			<option value="Naidu">Naidu</option>
			<option value="Naik">Naik</option>
			<option value="Nair">Nair</option>
			<option value="Nair Vaniya">Nair Vaniya</option>
			<option value="Nair Veluthedathu">Nair Veluthedathu</option>
			<option value="Nair Vilakkithala">Nair Vilakkithala</option>
			<option value="Nambiar">Nambiar</option>
			<option value="Namboodiri">Namboodiri</option>
			<option value="Namosudra">Namosudra</option>
			<option value="Napit">Napit</option>
			<option value="Navayat">Navayat</option>
			<option value="Nayaka">Nayaka</option>
			<option value="Nepali">Nepali</option>
			<option value="Nhavi">Nhavi</option>
			<option value="No Caste">No Caste</option>
			<option value="OBC - Barber (Nayee)">OBC - Barber (Nayee)</option>
			<option value="Oswal">Oswal</option>
			<option value="Others">Others</option>
			<option value="Padmasali">Padmasali</option>
			<option value="Pal">Pal</option>
			<option value="Panchal">Panchal</option>
			<option value="Panicker">Panicker</option>
			<option value="Parkava Kulam">Parkava Kulam</option>
			<option value="Parsees">Parsees</option>
			<option value="Pasi">Pasi</option>
			<option value="Patel">Patel</option>
			<option value="Patel Desai">Patel Desai</option>
			<option value="Patel Dodia">Patel Dodia</option>
			<option value="Pathan">Pathan</option>
			<option value="Patil">Patil</option>
			<option value="Patnaick">Patnaick</option>
			<option value="Patra">Patra</option>
			<option value="Pentecost">Pentecost</option>
			<option value="Perika">Perika</option>
			<option value="Pillai">Pillai</option>
			<option value="Porwal">Porwal</option>
			<option value="Prajapati">Prajapati</option>
			<option value="Prashnora Brahmin">Prashnora Brahmin</option>
			<option value="Protestant">Protestant</option>
			<option value="Punjabi">Punjabi</option>
			<option value="Qureshi">Qureshi</option>
			<option value="Rajaka">Rajaka</option>
			<option value="Rajastani">Rajastani</option>
			<option value="Rajbonshi">Rajbonshi</option>
			<option value="Rajput">Rajput</option>
			<option value="Rajput Garhwali">Rajput Garhwali</option>
			<option value="Rajput Kumaoni">Rajput Kumaoni</option>
			<option value="Rajput Rohella/Tank">Rajput Rohella/Tank</option>
			<option value="Ramdasia">Ramdasia</option>
			<option value="Ramgariah">Ramgariah</option>
			<option value="Ravidasia">Ravidasia</option>
			<option value="Rawat">Rawat</option>
			<option value="Reddiar">Reddiar</option>
			<option value="Reddy">Reddy</option>
			<option value="Roman Catholic">Roman Catholic</option>
			<option value="Rowther">Rowther</option>
			<option value="Sadgope">Sadgope</option>
			<option value="Saha">Saha</option>
			<option value="Sahu">Sahu</option>
			<option value="Saliya">Saliya</option>
			<option value="Scheduled Caste">Scheduled Caste</option>
			<option value="Scheduled Tribes">Scheduled Tribes</option>
			<option value="Senai Thalaivar">Senai Thalaivar</option>
			<option value="Sepahia">Sepahia</option>
			<option value="Setti Balija">Setti Balija</option>
			<option value="Settibalija">Settibalija</option>
			<option value="Shafi">Shafi</option>
			<option value="Shah">Shah</option>
			<option value="Sheikh">Sheikh</option>
			<option value="Sherager">Sherager</option>
			<option value="Shetty">Shetty</option>
			<option value="Shia">Shia</option>
			<option value="Shia Imami Ismaili">Shia Imami Ismaili</option>
			<option value="Shimpi">Shimpi</option>
			<option value="Shwetamber">Shwetamber</option>
			<option value="Siddiqui">Siddiqui</option>
			<option value="Sikh Ahluwalia">Sikh Ahluwalia</option>
			<option value="Sikh Arora">Sikh Arora</option>
			<option value="Sikh Bhatia">Sikh Bhatia</option>
			<option value="Sikh Clean Shaven">Sikh Clean Shaven</option>
			<option value="Sikh Ghumar">Sikh Ghumar</option>
			<option value="Sikh Gursikh">Sikh Gursikh</option>
			<option value="Sikh Intercaste">Sikh Intercaste</option>
			<option value="Sikh Jat">Sikh Jat</option>
			<option value="Sikh Kamboj">Sikh Kamboj</option>
			<option value="Sikh Kesadhari">Sikh Kesadhari</option>
			<option value="Sikh Khashap Rajpoot">Sikh Khashap Rajpoot</option>
			<option value="Sikh Khatri">Sikh Khatri</option>
			<option value="Sikh Kshatriya">Sikh Kshatriya</option>
			<option value="Sikh Lubana">Sikh Lubana</option>
			<option value="Sikh Majabi">Sikh Majabi</option>
			<option value="Sikh No Bar">Sikh No Bar</option>B
			<option value="Sikh Others">Sikh Others</option>
			<option value="Sikh Ramdasia">Sikh Ramdasia</option>
			<option value="Sikh Ramgharia">Sikh Ramgharia</option>
			<option value="Sikh Saini">Sikh Saini</option>
			<option value="Sindhi">Sindhi</option>
			<option value="Sindhi Amil">Sindhi Amil</option>
			<option value="Sindhi Baibhand">Sindhi Baibhand</option>
			<option value="Sindhi Bhanusali">Sindhi Bhanusali</option>
			<option value="Sindhi Bhatia">Sindhi Bhatia</option>
			<option value="Sindhi Chhapru">Sindhi Chhapru</option>
			<option value="Sindhi Dadu">Sindhi Dadu</option>
			<option value="Sindhi Hyderabadi">Sindhi Hyderabadi</option>
			<option value="Sindhi Larai">Sindhi Larai</option>
			<option value="Sindhi Larkana">Sindhi Larkana</option>
			<option value="Sindhi Lohana">Sindhi Lohana</option>
			<option value="Sindhi Rohiri">Sindhi Rohiri</option>
			<option value="Sindhi Sahiti">Sindhi Sahiti</option>
			<option value="Sindhi Sakkhar">Sindhi Sakkhar</option>
			<option value="Sindhi Sehwani">Sindhi Sehwani</option>
			<option value="Sindhi Shikarpuri">Sindhi Shikarpuri</option>
			<option value="Sindhi Thatai">Sindhi Thatai</option>
			<option value="SKP">SKP</option>
			<option value="Somavanshiya Sahasrarjuna Kshatriya(SSK)">Somavanshiya Sahasrarjuna Kshatriya(SSK)</option>
			<option value="Somvanshi">Somvanshi</option>
			<option value="Somvanshi Kayastha Prabhu">Somvanshi Kayastha Prabhu</option>
			<option value="Sonar">Sonar</option>
			<option value="Soni">Soni</option>
			<option value="Sourashtra">Sourashtra</option>
			<option value="Sozhiya Vellalar">Sozhiya Vellalar</option>
			<option value="Srisayani">Srisayani</option>
			<option value="Sudir">Sudir</option>
			<option value="Sundhi">Sundhi</option>
			<option value="Sunni">Sunni</option>
			<option value="Suthar">Suthar</option>
			<option value="Swakula Sali">Swakula Sali</option>
			<option value="Swarnkar">Swarnkar</option>
			<option value="Syed">Syed</option>
			<option value="Syrian">Syrian</option>
			<option value="Syrian Catholic">Syrian Catholic</option>
			<option value="Syrian Jacobite">Syrian Jacobite</option>
			<option value="Syrian Malabar">Syrian Malabar</option>
			<option value="Syrian Orthodox">Syrian Orthodox</option>
			<option value="Tamboli">Tamboli</option>
			<option value="Tamil Yadava">Tamil Yadava</option>
			<option value="Tanti">Tanti</option>
			<option value="Tantubai">Tantubai</option>
			<option value="Tantuway">Tantuway</option>
			<option value="Telaga">Telaga</option>
			<option value="Teli">Teli</option>
			<option value="Thakkar">Thakkar</option>
			<option value="Thakur">Thakur</option>
			<option value="Thevar">Thevar</option>
			<option value="Thigala">Thigala</option>
			<option value="Thiyya">Thiyya</option>
			<option value="Tili">Tili</option>
			<option value="Udaiyar">Udaiyar</option>
			<option value="Unspecified">Unspecified</option>
			<option value="Uppara">Uppara</option>
			<option value="Vadagalai">Vadagalai</option>
			<option value="Vaddera">Vaddera</option>
			<option value="Vaish">Vaish</option>
			<option value="Vaishnav">Vaishnav</option>
			<option value="Vaishnav Bhatia">Vaishnav Bhatia</option>
			<option value="Vaishnav Vanik">Vaishnav Vanik</option>
			<option value="Vaishnava">Vaishnava</option>
			<option value="Vaishya">Vaishya</option>
			<option value="Vaishya Vani">Vaishya Vani</option>
			<option value="Valmiki">Valmiki</option>
			<option value="Vania">Vania</option>
			<option value="Vaniya">Vaniya</option>
			<option value="Vanjara">Vanjara</option>
			<option value="Vanjari">Vanjari</option>
			<option value="Vankar">Vankar</option>
			<option value="Vannar">Vannar</option>
			<option value="Vannia Kula Kshatriyar">Vannia Kula Kshatriyar</option>
			<option value="Vanniyar">Vanniyar</option>
			<option value="Varshney">Varshney</option>
			<option value="Veera Saivam">Veera Saivam</option>
			<option value="Veerashaiva">Veerashaiva</option>
			<option value="Velama">Velama</option>
			<option value="Vellalar">Vellalar</option>
			<option value="Vellalar Devandra Kula">Vellalar Devandra Kula</option>
			<option value="Vishwakarma">Vishwakarma</option>
			<option value="Vokkaliga">Vokkaliga</option>
			<option value="Vysya">Vysya</option>
			<option value="Yadav">Yadav</option>
			<option value="Yadava">Yadava</option>
		</select>
		</td>
		
		<td class="txtBlack13Arial"><input type="text" value="" class="textBox_Admin" id="ym_sub_caste" name="ym_sub_caste" placeholder="Sub cast" style="width:100%; height:30px;"></td>
						
		<td class="txtBlack13Arial">
			<input type="text" class="textBox_Admin" id="ym_search" name="ym_search" placeholder="Name" value="" style="width:100%; height:30px;">
		</td>
		
		</tr>
		<tr>
		<th>Age</th>
		</tr>
		<tr>
		
		<td class="txtBlack13Arial">
								
			<select id="ym_age_start" name="ym_age_start" style="width:49%;">
                <option value="">From</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
				<option value="32">32</option>
				<option value="33">33</option>
				<option value="34">34</option>
				<option value="35">35</option>
				<option value="36">36</option>
				<option value="37">37</option>
				<option value="38">38</option>
				<option value="39">39</option>
               	<option value="40">40</option>
				<option value="41">41</option>
				<option value="42">42</option>
				<option value="43">43</option>
				<option value="44">44</option>
				<option value="45">45</option>
				<option value="46">46</option>
				<option value="47">47</option>
				<option value="48">48</option>
				<option value="49">49</option>
				<option value="50">50</option>
				<option value="51">51</option>
				<option value="52">52</option>
				<option value="53">53</option>
				<option value="54">54</option>
				<option value="55">55</option>
				<option value="56">56</option>
				<option value="57">57</option>
				<option value="58">58</option>
				<option value="59">59</option>
				<option value="60">60</option>
				<option value="61">61</option>
				<option value="62">62</option>
				<option value="63">63</option>
				<option value="64">64</option>
				<option value="65">65</option>
				<option value="66">66</option>
				<option value="67">67</option>
				<option value="68">68</option>
				<option value="69">69</option>
				<option value="70">70</option>
			</select>
			<select id="ym_age_end" name="ym_age_end" style="width:49%;">
                <option value="">To</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
				<option value="32">32</option>
				<option value="33">33</option>
				<option value="34">34</option>
				<option value="35">35</option>
				<option value="36">36</option>
				<option value="37">37</option>
				<option value="38">38</option>
				<option value="39">39</option>
               	<option value="40">40</option>
				<option value="41">41</option>
				<option value="42">42</option>
				<option value="43">43</option>
				<option value="44">44</option>
				<option value="45">45</option>
				<option value="46">46</option>
				<option value="47">47</option>
				<option value="48">48</option>
				<option value="49">49</option>
				<option value="50">50</option>
				<option value="51">51</option>
				<option value="52">52</option>
				<option value="53">53</option>
				<option value="54">54</option>
				<option value="55">55</option>
				<option value="56">56</option>
				<option value="57">57</option>
				<option value="58">58</option>
				<option value="59">59</option>
				<option value="60">60</option>
				<option value="61">61</option>
				<option value="62">62</option>
				<option value="63">63</option>
				<option value="64">64</option>
				<option value="65">65</option>
				<option value="66">66</option>
				<option value="67">67</option>
				<option value="68">68</option>
				<option value="69">69</option>
				<option value="70">70</option>
			</select>
		</td>
		<td></td>
		<td></td>
		<td class="txtBlack13Arial">
			<input type="submit" class="btn btn-primary" value="Search" id="ym_search_btn" name="ym_search_btn" style="margin: 0px 0px 10px 0px; width:49%; height:30px; float:left;">
			<input type="button" onclick="window.location='<?php echo base_url().'youth_milan/registration/clear'; ?>'" class="btn btn-danger" value="Clear" id="clear" name="clear" style="width:49%; height:30px; float:right;">
			
		</td>
		</tr>
	
	<?php echo form_close(); ?>
	
	</table>
	<!--update end-->
	<?php 
		if($search)
		{
		?>
		
			<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover" id="data-table">

			    <thead>
			
			        <tr>
					
						<th scope="col">Image</th>
						
			            <th scope="col">Name</th>
			
			            <th scope="col">Gender</th>
						
						<th scope="col">Marital Status</th>
			
						<!--<th scope="col">Having Children</th>-->
						<th scope="col">Occupation</th>
						<th scope="col">Height</th>
						
						<th scope="col">weight</th>
			
						<th scope="col">Body Type</th>
				
			            <th scope="col" width="30">View</th>
			
			        </tr>
			
			    </thead>
				
				<tfoot>
			
			    	<tr>
			
			        	<td colspan="9"></td>
			
			        </tr>
			
			    </tfoot>
				<tbody id="fatchdatahere">
		
		
		<?php
			
			foreach($search as $row)
			{
				$photo=$this->dbyouthmilan->check_exists_id7_2($row->ym_id);
				
				if(sizeof($photo)==0)
				{
					$photo1="nophoto.jpg";
				}
				else if($photo->ym_photo=='')
				{
					$photo1="nophoto.jpg";
				}
				else
				{
					$photo1=$photo->ym_photo;
				}
			
			?>
					<tr>
					
						<td>
							<a title="<?php echo $photo1; ?>" href="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $photo1; ?>" rel="lightbox">
								<img  src="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $photo1; ?>" height="30" width="30"/>
							</a>
						</td>
						
						<td><?php echo $row->ym_name; ?></td>
		
						<td><?php echo $row->ym_gender; ?></td>
					
						<td><?php echo $row->ym_marital_status; ?></td>
						
						<td><?php $occupation=$this->dbyouthmilan->check_exists_id4($row->ym_id);
						if($occupation)
						{
							echo $occupation->ym_occupation;
						}
						else
						{
							echo '';
						}
						//echo $row->ym_children; ?></td>
						
						<td><?php echo $row->ym_height." "."cms"; ?></td>
						
						<td><?php if($row->ym_weight!="0"){ echo $row->ym_weight." "."kgs / ".round($row->ym_weight*2.20462)." lbs";}else {echo "";} ?></td>
						<td><?php if($row->ym_body_type=='0' || $row->ym_body_type==''){ echo ''; } else{ echo $row->ym_body_type; } ?></td>
						
						<td> 
							
							<a href="<?php echo base_url(); ?>youth_milan/registration/more_detail/<?php echo $row->ym_id; ?>" title="More Detail" ><img  src="<?php echo base_url(); ?>images/youth_milan/plus.png" height="20" width="20"/></a>
							
						</td>
						
					</tr>
			
	<?php
			}
			
		}
		
		else
		{
		if($this->session->userdata('search_profile') || $this->session->userdata('rdcriteria') || $this->session->userdata('search_name') || $this->session->userdata('ym_gender') || $this->session->userdata('ym_marital_status') || $this->session->userdata('ym_body_type') || $this->session->userdata('ym_height_start') || $this->session->userdata('ym_height_end') || $this->session->userdata('ym_weight_start') || $this->session->userdata('ym_weight_end') || $this->session->userdata('ym_community') || $this->session->userdata('ym_caste') || $this->session->userdata('ym_sub_caste') || $this->session->userdata('ym_age_start') || $this->session->userdata('ym_age_end')){
		?>
			<!--updated by ketan 20130924-->
			<div style="width: 95%; background-color:#936263; color:fff; line-height:40px; padding-left:5%;">
			No result found!!!
			</div>
			<!--<div style="margin-left: 10px;">No result found!!!</div>-->
			<!--update end-->
		<?php	
		}
		}

	?>
	</tbody>
	</table>
	<?php echo $this->pagination->create_links(); ?>
</div>

<?php $this->load->view('youth_milan/layout/footer'); ?>
<script>
$(document).ready(function(){
$('#ym_marital_status').val('<?php echo $ym_marital_status; ?>');
$('#ym_body_type').val('<?php echo $ym_body_type; ?>');
$('#ym_height_start').val('<?php echo $ym_height_start; ?>');
$('#ym_height_end').val('<?php echo $ym_height_end; ?>');
//for age
$('#ym_age_start').val('<?php echo $ym_age_start; ?>');
$('#ym_age_end').val('<?php echo $ym_age_end; ?>');
//end
$('#ym_weight_start').val('<?php echo $ym_weight_start; ?>');
$('#ym_weight_end').val('<?php echo $ym_weight_end; ?>');
$('#ym_community').val('<?php echo $ym_community; ?>');
$('#ym_caste').val('<?php echo $ym_caste; ?>');
$('#ym_sub_caste').val('<?php echo $ym_sub_caste; ?>');
$('#ym_search').val('<?php echo $search_name; ?>');
$('input[name=rdcriteria][value=<?php echo $rdcriteria; ?>]').prop("checked",true);
$('input[name=ym_gender][value=<?php echo $ym_gender; ?>]').prop("checked",true);
});
</script>