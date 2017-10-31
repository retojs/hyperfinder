<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.teleboy.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<span id="tv_jetzt">
			Was l&auml;uft 
			<br/>
			<select id="tv_arg1" onChange="setLastField('tv_jetzt');onPressKey('tv');gotoURL()">
				<option value="jetzt" >... jetzt</option>
				<option value="30" >... in 30 Minuten</option>
				<option value="primetime" >... heute um 20:15 h</option>
				<option value="primetime2" >... heute um 21:15 h</option>
				<option value="latenight" >... heute um 22:15 h</option>					
				<option value="night" >... heute um 23:15 h</option>					
			</select>
		</span>
	</td>
	<td class="separator_left">
		Name / Stichwort
		<br/>
		<input name="fuzzy" type="text" id="tv_arg2" onFocus="selectField('tv_arg2')" onKeyDown="setLastField('tv_fuzzy');onPressKey('tv')">
	</td>
	<td nowrap style="border-left:1px dashed #ddd">
		Sender
		<br/>
		<select name="id" id="tv_arg3" onChange="setLastField('tv_sender');onPressKey('tv');gotoURL()"">
			<option value="3">TV-Sender</option>
			<option value="3">------ Schweiz</option>
			<option value="3">SF1</option>
			<option value="4">SF2</option>
			<option value="5">SFi</option>
			<option value="144">HD suisse</option>
			<option value="19">STAR TV</option>
			<option value="18">VIVA Schweiz</option>
			<option value="138">3+</option>
			<option value="113">U1</option>
			
			<option value="12">------ Romandie</option>
			<option value="12">tsr1</option>
			<option value="13">tsr2</option>
			<option value="128">Tvrl</option>
			<option value="127">TVM3</option>
					
			<option value="14">------ Tessin</option>
			<option value="14">tsi1</option>
			<option value="15">tsi2</option>
			
			<option value="72">------ Regional</option>
			<option value="72">TeleZüri</option>
			<option value="21">TeleBasel</option>
			<option value="22">TeleBärn</option>
			<option value="20">TeleM1</option>
			<option value="84">TeleTell</option>
			<option value="85">tvo</option>
			
			<option value="1">------ Deutsch</option>
			<option value="1">ARD</option>
			<option value="2">ZDF</option>
			<option value="8">RTL</option>
			<option value="10">Sat1</option>
			<option value="9">Pro7</option>
			<option value="23">RTL2</option>
			<option value="25">Vox</option>
			<option value="26">Kabel1</option>
			<option value="6">ORF1</option>
			<option value="7">ORF2</option>
			<option value="11">3sat</option>
			<option value="24">arte</option>
			<option value="33">superRTL</option>
			<option value="27">BR</option>
			<option value="31">MDR</option>
			<option value="30">WDR</option>
			<option value="29">SWR-BW</option>
			<option value="28">NDR</option>
			<option value="42">hr</option>
			<option value="39">rbb</option>
			<option value="86">Tele5</option>
			
			<option value="40">------ Digital</option>
			<option value="40">BR-alpha</option>
			<option value="41">DW</option>
			<option value="121">ZDF doku</option>
			<option value="122">ZDF theater</option>
			<option value="46">PHOENIX</option>
			<option value="48">EinsFestival</option>
			<option value="47">EinsPlus</option>
			<option value="115">EinsExtra</option>
			
			<option value="56">------ Français</option>
			<option value="56">TF1</option>
			<option value="57">France2</option>
			<option value="58">France3</option>
			<option value="80">France5</option>
			<option value="61">TV5</option>
			<option value="59">M6</option>
			<option value="130">arte</option>
			<option value="123">EUROSport</option>
			<option value="116">RTL9</option>
			<option value="76">National Geographic FR</option>
			<option value="119">MCM</option>
			
			<option value="52">------ Italiano</option>
			<option value="52">RAIUNO</option>
			<option value="53">RAIDUE</option>
			<option value="82">Rete4</option>
			<option value="55">Canale5</option>
			<option value="81">Italia1</option>
			
			<option value="50">------ English</option>
			<option value="50">CNN</option>
			<option value="131">CNBC</option>
			<option value="49">BBC Prime</option>
			<option value="101">BBC World</option>
			<option value="75">National Geographic UK</option>
			<option value="134">MTV Europe</option>
			<option value="132">EURO Sport</option>
			
			<option value="88">------ Teleclub</option>
			<option value="88">Teleclub Cinema</option>
			<option value="96">Teleclub Star</option>
			<option value="90">Disney</option>
			<option value="111">MGM</option>
			<option value="102">13th Street</option>
			<option value="110">SciFi</option>
			<option value="93">PremiereSerie</option>
			<option value="92">PremiereKrimi</option>
			<option value="94">Teleclub Sport 1</option>
			<option value="95">Teleclub Sport 2</option>
			<option value="87">Teleclub Sport 3</option>
			<option value="89">Discovery</option>
			<option value="124">DiscoveryGeschichte</option>
			<option value="114">Animal</option>
			<option value="139">Hit24</option>
			<option value="126">Focus Gesundheit</option>
			<option value="125">Jetix</option>
			
			<option value="35">------ Sparten</option>
			<option value="35">EURO Sport</option>
			<option value="135">EURP Sport 2</option>
			<option value="36">DSF</option>
			<option value="37">MTV</option>
			<option value="70">VIVA</option>
			<option value="140">ComedyCentral</option>
			<option value="38">n-tv</option>
			<option value="67">EuroNews</option>
			<option value="44">N24</option>
			<option value="64">Bloomberg</option>
			<option value="83">HSE24</option>
			<option value="43">KiKa</option>
			<option value="141">Nick</option>
			
		</select>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('tv');gotoURL()">
	</td>
</tr>