﻿<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<a name="fx"></a>
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.oanda.com/convert/classic?lang=de"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input name="value" value="100" size=7 maxlength=15 id="fx_arg1" onFocus="selectField('fx_arg1')" onKeyDown="onPressKey('fx')">
		Betrag
		<br/>
		<select name="exch" size=1 class="wideinput" onkeydown="onPressKey('fx');submitForm(event)">
					<option value="CHF">Schweizer Franken . CHF
			</option><option value="EUR" selected>Euro . EUR
			</option><option value="USD">US Dollar . USD
			</option><option value="EGP">&Auml;gyptisches Pfund . EGP
			</option><option value="ETB">&Auml;thiopischer Birr . ETB
			</option><option value="ATS">&Ouml;sterreichischer Schilling . ATS
			</option><option value="AFA">Afghanischer Afghani . AFA
			</option><option value="ALL">Albanischer Lek . ALL
			</option><option value="DZD">Algerischer Dinar . DZD
			</option><option value="ADP">Andorranische Pesete . ADP
			</option><option value="ADF">Andorranischer Franc . ADF
			</option><option value="AON">Angolanischer Kwanza . AON
			</option><option value="ARS">Argentinischer Peso . ARS
			</option><option value="AWG">Aruba Florin . AWG
			</option><option value="AUD">Australischer Dollar . AUD
			</option><option value="BSD">Bahama-Dollar . BSD
			</option><option value="BHD">Bahrain-Dinar . BHD
			</option><option value="BDT">Bangladeschischer Taka . BDT
			</option><option value="BBD">Barbados-Dollar . BBD
			</option><option value="BEF">Belgischer Franc . BEF
			</option><option value="BZD">Belize-Dollar . BZD
			</option><option value="BMD">Bermuda-Dollar . BMD
			</option><option value="BTN">Bhutanischer Ngultrum . BTN
			</option><option value="BOB">Bolivianischer Boliviano . BOB
			</option><option value="BWP">Botsuanischer Pula . BWP
			</option><option value="BRL">Brasilianischer Real . BRL
			</option><option value="GBP">Britisches Pfund . GBP
			</option><option value="BND">Brunei-Dollar . BND
			</option><option value="BGN">Bulgarischer Lew . BGN
			</option><option value="BIF">Burundi-Franc . BIF
			</option><option value="XOF">CFA Franc BCEAO . XOF
			</option><option value="XAF">CFA Franc BEAC . XAF
			</option><option value="CLP">Chilenischer Peso . CLP
			</option><option value="CNY">Chinesischer Renminbi Yuan . CNY
			</option><option value="CRC">Costa-Rica-Col&oacute;n . CRC
			</option><option value="DKK">D&auml;nische Krone . DKK
			</option><option value="DEM">Deutsche Mark . DEM
			</option><option value="DOP">Dominikanischer Peso . DOP
			</option><option value="DJF">Dschibuti-Franc . DJF
			</option><option value="XEU">ECU . XEU
			</option><option value="XCD">East Caribbean Dollar . XCD
			</option><option value="ECS">Ecuadorianischer Sucre . ECS
			</option><option value="SVC">El-Salvador-Col&oacute;n . SVC
			</option><option value="EEK">Estnische Krone . EEK
			</option><option value="FKP">Falkland-Pfund . FKP
			</option><option value="FJD">Fidschi-Dollar . FJD
			</option><option value="FIM">Finnische Mark . FIM
			</option><option value="FRF">Franz&ouml;sischer Franc . FRF
			</option><option value="GMD">Gambischer Dalasi . GMD
			</option><option value="GHC">Ghanaischer Cedi . GHC
			</option><option value="GIP">Gibraltar-Pfund . GIP
			</option><option value="XAU">Gold (Uz.) . XAU
			</option><option value="GRD">Griechische Drachme . GRD
			</option><option value="GTQ">Guatemaltekischer Quetzal . GTQ
			</option><option value="GNF">Guinea-Franc . GNF
			</option><option value="GYD">Guyana-Dollar . GYD
			</option><option value="HTG">Haitianische Gourde . HTG
			</option><option value="NLG">Holl&auml;ndischer Gulden . NLG
			</option><option value="HNL">Honduranische Lempira . HNL
			</option><option value="HKD">Hongkong-Dollar . HKD
			</option><option value="INR">Indische Rupie . INR
			</option><option value="IDR">Indonesische Rupiah . IDR
			</option><option value="IQD">Irakischer Dinar . IQD
			</option><option value="IRR">Iranischer Rial . IRR
			</option><option value="IEP">Irisches Pfund . IEP
			</option><option value="ISK">Isl&auml;ndische Krone . ISK
			</option><option value="ILS">Israelischer Neuer Schekel . ILS
			</option><option value="ITL">Italienische Lire . ITL
			</option><option value="JMD">Jamaikanischer Dollar . JMD
			</option><option value="JPY">Japanischer Yen . JPY
			</option><option value="JOD">Jordanischer Dinar . JOD
			</option><option value="YUN">Jugoslawischer Dinar . YUN
			</option><option value="KYD">Kaiman-Dollar . KYD
			</option><option value="KHR">Kambodschanischer Riel . KHR
			</option><option value="CAD">Kanadischer Dollar . CAD
			</option><option value="CVE">Kap-Verde-Escudo . CVE
			</option><option value="KZT">Kasachstan Tenge . KZT
			</option><option value="QAR">Katar-Rial . QAR
			</option><option value="KES">Kenianischer Schilling . KES
			</option><option value="COP">Kolumbianischer Peso . COP
			</option><option value="KMF">Komoren-Franc . KMF
			</option><option value="HRK">Kroatische Kuna . HRK
			</option><option value="CUP">Kubanischer Peso . CUP
			</option><option value="CUC">Kubanischer Umwandelbar Peso . CUC
			</option><option value="KWD">Kuwaitischer Dinar . KWD
			</option><option value="LAK">Laotischer Kip . LAK
			</option><option value="LSL">Lesothischer Loti . LSL
			</option><option value="LVL">Lettische Lats . LVL
			</option><option value="LBP">Libanesisches Pfund . LBP
			</option><option value="LRD">Liberianischer Dollar . LRD
			</option><option value="LYD">Libyscher Dinar . LYD
			</option><option value="LTL">Litauische Litas . LTL
			</option><option value="LUF">Luxemburgischer Franc . LUF
			</option><option value="MOP">Macauische Pataca . MOP
			</option><option value="MGA">Madagaskar-Ariary . MGA
			</option><option value="MGF">Madagaskar-Franc . MGF
			</option><option value="MWK">Malawi-Kwacha . MWK
			</option><option value="MYR">Malaysischer Ringgit . MYR
			</option><option value="MVR">Maledivische Rufiyaa . MVR
			</option><option value="MTL">Maltesische Lire . MTL
			</option><option value="MAD">Marokkanischer Dirham . MAD
			</option><option value="MRO">Mauretanische Ouguiya . MRO
			</option><option value="MUR">Mauritius-Rupie . MUR
			</option><option value="MXN">Mexikanischer Peso . MXN
			</option><option value="MNT">Mongolischer Tugrik . MNT
			</option><option value="MZM">Mosambikanischer Metical . MZM
			</option><option value="MMK">Myanmarischer Kyat . MMK
			</option><option value="ANG">NL-Antillen-Gulden . ANG
			</option><option value="NAD">Namibischer Dollar . NAD
			</option><option value="NPR">Nepalesische Rupie . NPR
			</option><option value="NZD">Neusel&auml;ndischer Dollar . NZD
			</option><option value="NIO">Nicaraguanischer C&oacute;rdoba . NIO
			</option><option value="NGN">Nigerianische Naira . NGN
			</option><option value="KPW">Nordkoreanischer Won . KPW
			</option><option value="NOK">Norwegische Krone . NOK
			</option><option value="OMR">Omani Rial . OMR
			</option><option value="PKR">Pakistanische Rupie . PKR
			</option><option value="XPD">Palladium (Uz.) . XPD
			</option><option value="PAB">Panamaischer Balboa . PAB
			</option><option value="PGK">Papua-Neuguinea-Kina . PGK
			</option><option value="PYG">Paraguayischer Guarani . PYG
			</option><option value="PEN">Peruanischer Sol . PEN
			</option><option value="PHP">Philippinischer Peso . PHP
			</option><option value="XPT">Platin (Uz.) . XPT
			</option><option value="PLN">Polnischer Zloty . PLN
			</option><option value="PTE">Portugiesischer Escudo . PTE
			</option><option value="ROL">Rum&auml;nischer Lei . ROL
			</option><option value="RON">Rum&auml;nischer Neue Lei . RON
			</option><option value="RUB">Russischer Rubel . RUB
			</option><option value="STD">S&atilde;o-Tom&eacute;/Pr&iacute;ncipe-Dobra . STD
			</option><option value="ZAR">S&uuml;dafrikanischer Rand . ZAR
			</option><option value="KRW">S&uuml;dkoreanischer Won . KRW
			</option><option value="SBD">Salomonen-Dollar . SBD
			</option><option value="ZMK">Sambischer Kwacha . ZMK
			</option><option value="WST">Samoanischer Tala . WST
			</option><option value="SAR">Saudi Riyal . SAR
			</option><option value="SEK">Schwedische Krone . SEK
			</option><option value="CSD">Serbischer Dinar . CSD
			</option><option value="SCR">Seychellen-Rupie . SCR
			</option><option value="SLL">Sierraleonische Leone . SLL
			</option><option value="XAG">Silber (Uz.) . XAG
			</option><option value="ZWD">Simbabwe-Dollar . ZWD
			</option><option value="SGD">Singapur-Dollar . SGD
			</option><option value="SKK">Slovakische Krone . SKK
			</option><option value="SIT">Slowenischer Tolar . SIT
			</option><option value="SOS">Somalischer Schilling . SOS
			</option><option value="ESP">Spanische Pesete . ESP
			</option><option value="LKR">Sri-Lanka-Rupie . LKR
			</option><option value="SHP">St. Helena-Pfund . SHP
			</option><option value="SDD">Sudanesischer Dinar . SDD
			</option><option value="SDP">Sudanesisches Pfund . SDP
			</option><option value="SRD">Suriname-Dollar . SRD
			</option><option value="SRG">Suriname-Gulden . SRG
			</option><option value="SZL">Swasil&auml;discher Lilangeni . SZL
			</option><option value="SYP">Syrisches Pfund . SYP
			</option><option value="TRL">T&uuml;rkische Lire . TRL
			</option><option value="TRY">T&uuml;rkische Neue Lire . TRY
			</option><option value="TWD">Taiwanesischer Dollar . TWD
			</option><option value="TZS">Tansania-Schilling . TZS
			</option><option value="THB">Thail&auml;ndischer Baht . THB
			</option><option value="TOP">Tongaische Pa'anga . TOP
			</option><option value="TTD">Trinidad/Tobago-Dollar . TTD
			</option><option value="CZK">Tschechische Krone . CZK
			</option><option value="TND">Tunesischer Dinar . TND
			</option><option value="UGS">Uganda-Schilling . UGS
			</option><option value="UAH">Ukrainische Griwna . UAH
			</option><option value="HUF">Ungarischer Forint . HUF
			</option><option value="UYP">Uruguayischer Peso . UYP
			</option><option value="VUV">Vanuatu-Vatu . VUV
			</option><option value="VEB">Venezuelanischer Bolivar . VEB
			</option><option value="AED">Ver. Arab. Emir.-Dirham . AED
			</option><option value="VND">Vietnamesischer Dong . VND
			</option><option value="YER">Yemen Rial . YER
			</option><option value="XPF">Zentraler Pazifischer Franc . XPF
			</option><option value="CYP">Zypern-Pfund . CYP 
		</select>
	</td>
	<td colspan="2">	
	wechseln zu <input style="visibility:hidden" />
	<br/>
		<select name="expr" size=1 class="wideinput" onkeydown="onPressKey('fx');submitForm(event)">
					<option value="CHF" selected>Schweizer Franken . CHF
			</option><option value="EUR">Euro . EUR
			</option><option value="USD">US Dollar . USD
			</option><option value="EGP">&Auml;gyptisches Pfund . EGP
			</option><option value="ETB">&Auml;thiopischer Birr . ETB
			</option><option value="ATS">&Ouml;sterreichischer Schilling . ATS
			</option><option value="AFA">Afghanischer Afghani . AFA
			</option><option value="ALL">Albanischer Lek . ALL
			</option><option value="DZD">Algerischer Dinar . DZD
			</option><option value="ADP">Andorranische Pesete . ADP
			</option><option value="ADF">Andorranischer Franc . ADF
			</option><option value="AON">Angolanischer Kwanza . AON
			</option><option value="ARS">Argentinischer Peso . ARS
			</option><option value="AWG">Aruba Florin . AWG
			</option><option value="AUD">Australischer Dollar . AUD
			</option><option value="BSD">Bahama-Dollar . BSD
			</option><option value="BHD">Bahrain-Dinar . BHD
			</option><option value="BDT">Bangladeschischer Taka . BDT
			</option><option value="BBD">Barbados-Dollar . BBD
			</option><option value="BEF">Belgischer Franc . BEF
			</option><option value="BZD">Belize-Dollar . BZD
			</option><option value="BMD">Bermuda-Dollar . BMD
			</option><option value="BTN">Bhutanischer Ngultrum . BTN
			</option><option value="BOB">Bolivianischer Boliviano . BOB
			</option><option value="BWP">Botsuanischer Pula . BWP
			</option><option value="BRL">Brasilianischer Real . BRL
			</option><option value="GBP">Britisches Pfund . GBP
			</option><option value="BND">Brunei-Dollar . BND
			</option><option value="BGN">Bulgarischer Lew . BGN
			</option><option value="BIF">Burundi-Franc . BIF
			</option><option value="XOF">CFA Franc BCEAO . XOF
			</option><option value="XAF">CFA Franc BEAC . XAF
			</option><option value="CLP">Chilenischer Peso . CLP
			</option><option value="CNY">Chinesischer Renminbi Yuan . CNY
			</option><option value="CRC">Costa-Rica-Col&oacute;n . CRC
			</option><option value="DKK">D&auml;nische Krone . DKK
			</option><option value="DEM">Deutsche Mark . DEM
			</option><option value="DOP">Dominikanischer Peso . DOP
			</option><option value="DJF">Dschibuti-Franc . DJF
			</option><option value="XEU">ECU . XEU
			</option><option value="XCD">East Caribbean Dollar . XCD
			</option><option value="ECS">Ecuadorianischer Sucre . ECS
			</option><option value="SVC">El-Salvador-Col&oacute;n . SVC
			</option><option value="EEK">Estnische Krone . EEK
			</option><option value="FKP">Falkland-Pfund . FKP
			</option><option value="FJD">Fidschi-Dollar . FJD
			</option><option value="FIM">Finnische Mark . FIM
			</option><option value="FRF">Franz&ouml;sischer Franc . FRF
			</option><option value="GMD">Gambischer Dalasi . GMD
			</option><option value="GHC">Ghanaischer Cedi . GHC
			</option><option value="GIP">Gibraltar-Pfund . GIP
			</option><option value="XAU">Gold (Uz.) . XAU
			</option><option value="GRD">Griechische Drachme . GRD
			</option><option value="GTQ">Guatemaltekischer Quetzal . GTQ
			</option><option value="GNF">Guinea-Franc . GNF
			</option><option value="GYD">Guyana-Dollar . GYD
			</option><option value="HTG">Haitianische Gourde . HTG
			</option><option value="NLG">Holl&auml;ndischer Gulden . NLG
			</option><option value="HNL">Honduranische Lempira . HNL
			</option><option value="HKD">Hongkong-Dollar . HKD
			</option><option value="INR">Indische Rupie . INR
			</option><option value="IDR">Indonesische Rupiah . IDR
			</option><option value="IQD">Irakischer Dinar . IQD
			</option><option value="IRR">Iranischer Rial . IRR
			</option><option value="IEP">Irisches Pfund . IEP
			</option><option value="ISK">Isl&auml;ndische Krone . ISK
			</option><option value="ILS">Israelischer Neuer Schekel . ILS
			</option><option value="ITL">Italienische Lire . ITL
			</option><option value="JMD">Jamaikanischer Dollar . JMD
			</option><option value="JPY">Japanischer Yen . JPY
			</option><option value="JOD">Jordanischer Dinar . JOD
			</option><option value="YUN">Jugoslawischer Dinar . YUN
			</option><option value="KYD">Kaiman-Dollar . KYD
			</option><option value="KHR">Kambodschanischer Riel . KHR
			</option><option value="CAD">Kanadischer Dollar . CAD
			</option><option value="CVE">Kap-Verde-Escudo . CVE
			</option><option value="KZT">Kasachstan Tenge . KZT
			</option><option value="QAR">Katar-Rial . QAR
			</option><option value="KES">Kenianischer Schilling . KES
			</option><option value="COP">Kolumbianischer Peso . COP
			</option><option value="KMF">Komoren-Franc . KMF
			</option><option value="HRK">Kroatische Kuna . HRK
			</option><option value="CUP">Kubanischer Peso . CUP
			</option><option value="CUC">Kubanischer Umwandelbar Peso . CUC
			</option><option value="KWD">Kuwaitischer Dinar . KWD
			</option><option value="LAK">Laotischer Kip . LAK
			</option><option value="LSL">Lesothischer Loti . LSL
			</option><option value="LVL">Lettische Lats . LVL
			</option><option value="LBP">Libanesisches Pfund . LBP
			</option><option value="LRD">Liberianischer Dollar . LRD
			</option><option value="LYD">Libyscher Dinar . LYD
			</option><option value="LTL">Litauische Litas . LTL
			</option><option value="LUF">Luxemburgischer Franc . LUF
			</option><option value="MOP">Macauische Pataca . MOP
			</option><option value="MGA">Madagaskar-Ariary . MGA
			</option><option value="MGF">Madagaskar-Franc . MGF
			</option><option value="MWK">Malawi-Kwacha . MWK
			</option><option value="MYR">Malaysischer Ringgit . MYR
			</option><option value="MVR">Maledivische Rufiyaa . MVR
			</option><option value="MTL">Maltesische Lire . MTL
			</option><option value="MAD">Marokkanischer Dirham . MAD
			</option><option value="MRO">Mauretanische Ouguiya . MRO
			</option><option value="MUR">Mauritius-Rupie . MUR
			</option><option value="MXN">Mexikanischer Peso . MXN
			</option><option value="MNT">Mongolischer Tugrik . MNT
			</option><option value="MZM">Mosambikanischer Metical . MZM
			</option><option value="MMK">Myanmarischer Kyat . MMK
			</option><option value="ANG">NL-Antillen-Gulden . ANG
			</option><option value="NAD">Namibischer Dollar . NAD
			</option><option value="NPR">Nepalesische Rupie . NPR
			</option><option value="NZD">Neusel&auml;ndischer Dollar . NZD
			</option><option value="NIO">Nicaraguanischer C&oacute;rdoba . NIO
			</option><option value="NGN">Nigerianische Naira . NGN
			</option><option value="KPW">Nordkoreanischer Won . KPW
			</option><option value="NOK">Norwegische Krone . NOK
			</option><option value="OMR">Omani Rial . OMR
			</option><option value="PKR">Pakistanische Rupie . PKR
			</option><option value="XPD">Palladium (Uz.) . XPD
			</option><option value="PAB">Panamaischer Balboa . PAB
			</option><option value="PGK">Papua-Neuguinea-Kina . PGK
			</option><option value="PYG">Paraguayischer Guarani . PYG
			</option><option value="PEN">Peruanischer Sol . PEN
			</option><option value="PHP">Philippinischer Peso . PHP
			</option><option value="XPT">Platin (Uz.) . XPT
			</option><option value="PLN">Polnischer Zloty . PLN
			</option><option value="PTE">Portugiesischer Escudo . PTE
			</option><option value="ROL">Rum&auml;nischer Lei . ROL
			</option><option value="RON">Rum&auml;nischer Neue Lei . RON
			</option><option value="RUB">Russischer Rubel . RUB
			</option><option value="STD">S&atilde;o-Tom&eacute;/Pr&iacute;ncipe-Dobra . STD
			</option><option value="ZAR">S&uuml;dafrikanischer Rand . ZAR
			</option><option value="KRW">S&uuml;dkoreanischer Won . KRW
			</option><option value="SBD">Salomonen-Dollar . SBD
			</option><option value="ZMK">Sambischer Kwacha . ZMK
			</option><option value="WST">Samoanischer Tala . WST
			</option><option value="SAR">Saudi Riyal . SAR
			</option><option value="SEK">Schwedische Krone . SEK
			</option><option value="CSD">Serbischer Dinar . CSD
			</option><option value="SCR">Seychellen-Rupie . SCR
			</option><option value="SLL">Sierraleonische Leone . SLL
			</option><option value="XAG">Silber (Uz.) . XAG
			</option><option value="ZWD">Simbabwe-Dollar . ZWD
			</option><option value="SGD">Singapur-Dollar . SGD
			</option><option value="SKK">Slovakische Krone . SKK
			</option><option value="SIT">Slowenischer Tolar . SIT
			</option><option value="SOS">Somalischer Schilling . SOS
			</option><option value="ESP">Spanische Pesete . ESP
			</option><option value="LKR">Sri-Lanka-Rupie . LKR
			</option><option value="SHP">St. Helena-Pfund . SHP
			</option><option value="SDD">Sudanesischer Dinar . SDD
			</option><option value="SDP">Sudanesisches Pfund . SDP
			</option><option value="SRD">Suriname-Dollar . SRD
			</option><option value="SRG">Suriname-Gulden . SRG
			</option><option value="SZL">Swasil&auml;discher Lilangeni . SZL
			</option><option value="SYP">Syrisches Pfund . SYP
			</option><option value="TRL">T&uuml;rkische Lire . TRL
			</option><option value="TRY">T&uuml;rkische Neue Lire . TRY
			</option><option value="TWD">Taiwanesischer Dollar . TWD
			</option><option value="TZS">Tansania-Schilling . TZS
			</option><option value="THB">Thail&auml;ndischer Baht . THB
			</option><option value="TOP">Tongaische Pa'anga . TOP
			</option><option value="TTD">Trinidad/Tobago-Dollar . TTD
			</option><option value="CZK">Tschechische Krone . CZK
			</option><option value="TND">Tunesischer Dinar . TND
			</option><option value="UGS">Uganda-Schilling . UGS
			</option><option value="UAH">Ukrainische Griwna . UAH
			</option><option value="HUF">Ungarischer Forint . HUF
			</option><option value="UYP">Uruguayischer Peso . UYP
			</option><option value="VUV">Vanuatu-Vatu . VUV
			</option><option value="VEB">Venezuelanischer Bolivar . VEB
			</option><option value="AED">Ver. Arab. Emir.-Dirham . AED
			</option><option value="VND">Vietnamesischer Dong . VND
			</option><option value="YER">Yemen Rial . YER
			</option><option value="XPF">Zentraler Pazifischer Franc . XPF
			</option><option value="CYP">Zypern-Pfund . CYP
		</select>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('fx');gotoURL()">
	</td>
</tr>