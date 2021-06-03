
apt-get update
apt-get install -y apache2 apache2-utils
a2enmod rewrite
sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/sites-available/default

#Install php
apt -y install libapache2-mod-php
a2enmod php7.2

#Install php-dom
apt-get install php-dom

#Install mySQL
apt-get update -y
debconf-set-selections <<< 'mysql-server-<version> mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server-<version> mysql-server/root_password_again password password'
apt-get install -y mariadb-server mariadb-client
systemctl enable mariadb
#apt-get install -y mysql-server

# Connect PHP and MySQL
apt install php-mysql -y
systemctl restart apache2

# Setup database
mysql -uroot -ppassword -e "CREATE DATABASE tecnoticos;
use tecnoticos;

CREATE TABLE dilema (
  id_dilema int AUTO_INCREMENT,
  titulo_dilema varchar(250) CHARACTER SET utf8 NOT NULL,
  recurso_dilema text CHARACTER SET utf8 NOT NULL, 
  resumen_dilema text CHARACTER SET utf8 NOT NULL,
  descripcion_dilema text CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (id_dilema)
);

CREATE TABLE pregunta (
  id_pregunta int AUTO_INCREMENT,
  texto_pregunta text NOT NULL,
id_dilema int NOT NULL,
tipo_numeracion VARCHAR(10),
PRIMARY KEY (id_pregunta),
FOREIGN KEY(id_dilema) REFERENCES dilema(id_dilema)
);

CREATE TABLE instituto (
id_instituto int AUTO_INCREMENT,
nombre_instituto varchar(250) NOT NULL,
dominio_instituto varchar(250) NOT NULL,
PRIMARY KEY (id_instituto)
);

CREATE TABLE usuario (
  id_usuario int AUTO_INCREMENT,
  edad int(3) NOT NULL,
  correo varchar(250) NOT NULL,
  contraseña varchar(250) NOT NULL,
  sexo varchar(1) NOT NULL,
  rol varchar(20) DEFAULT 'usuario',
  id_instituto int,
PRIMARY KEY (id_usuario),
FOREIGN KEY (id_instituto) REFERENCES instituto(id_instituto)
);

CREATE TABLE respuesta (
 id_respuesta int AUTO_INCREMENT,
texto_respuesta text NOT NULL,
   id_usuario int NOT NULL,
  id_pregunta int NOT NULL,
id_dilema INT NOT NULL,
PRIMARY KEY (id_respuesta),
FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
FOREIGN KEY (id_pregunta) REFERENCES pregunta(id_pregunta),
FOREIGN KEY (id_dilema) REFERENCES dilema(id_dilema)
);

INSERT INTO instituto (nombre_instituto, dominio_instituto) VALUES ('INS Nicolau Copernic', 'alumnat.copernic');

INSERT INTO usuario (edad, correo, contraseña, sexo, rol, id_instituto) VALUES ('33', 'admin@admin.com', 'admin', 'M', 'admin', 1);
INSERT INTO usuario (edad, correo, contraseña, sexo, rol, id_instituto) VALUES ('18', 'usuario@usuario.com', 'usuario', 'H', 'usuario', 1);

INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>MÃ quines intelÂ·ligents</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>El vehÃ­culo autÃ³nomo <a href=\"https://es.wikipedia.org/wiki/Veh%C3%ADculo_aut%C3%B3nomo\">https://es.wikipedia.org/wiki/Veh%C3%ADculo_autÃ³nomo</a></li><li>Seguridad en robÃ³tica y vehÃ­culos autÃ³nomos <a href=\"https://racimo.usal.edu.ar/6736/1/P%C3%A1ginas%20desdeTesis.5000256867.Seguridad%20en%20rob%C3%B3tica%20y%20veh%C3%ADculos%20aut%C3%B3nomos.pdf\">https://racimo.usal.edu.ar/6736/1/PÃ¡ginas%20desdeTesis.5000256867.Seguridad%20en%20robÃ³tica%20y%20veh%C3%ADculos%20autÃ³nomos.pdf</a></li><li>Hacia los coches robot <a href=\"https://motor.elpais.com/tecnologia/coches-robot-coche-autonomo/\">https://motor.elpais.com/tecnologia/coches-robot-coche-autonomo/</a></li><li>Coches autÃ³nomos <a href=\"https://www.xataka.com/tag/coches-autonomos\">https://www.xataka.com/tag/coches-autonomos</a></li></ul>', '<p>Coneixes el concepte de<i> <strong>VEHICLE AUTÃ’NOM</strong> </i>o<i> <strong>VEHICLE ROBOTITZAT</strong>?</i></p>', '<p>Un vehicle autÃ²nom no necessita que algÃº el condueixi, sâ€™autocondueix. Lâ€™objectiu dâ€™aquest invent Ã©s que els humans poguem desplaÃ§ar-nos sense haver de conduir i amb la possibilitat de fer altres tasques en els trajectes, com llegir o dormir, entre dâ€™altres.</p><p>Avui dia gaudim de lâ€™automatisme parcial, dâ€™una conducciÃ³ guiada mÃ©s fÃ cil; perÃ² es preveu que de lâ€™any 2020 en endavant sâ€™avanÃ§i per arribar a lâ€™automatisme total.</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>Pseudotecnologia</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>DefiniciÃ³n <a href=\"https://dle.rae.es/seudo-\">https://dle.rae.es/seudo-</a></li><li>Por quÃ© la radiaciÃ³n del WiFi no causa cÃ¡ncer <a href=\"https://elpais.com/elpais/2018/10/29/ciencia/1540833221_960561.html\">https://elpais.com/elpais/2018/10/29/ciencia/1540833221_960561.html</a></li><li>OMS <a href=\"https://www.who.int/es/news-room/fact-sheets/detail/electromagnetic-fields-and-public-health-mobile-phones\">https://www.who.int/es/news-room/fact-sheets/detail/electromagnetic-fields-and-public-health-mobile-phones</a></li><li>Darwin, te necesito <a href=\"https://elpais.com/agr/darwin_te_necesito/a/\">https://elpais.com/agr/darwin_te_necesito/a/</a></li></ul>', '<p><i>No existeixen&nbsp;<strong>EVIDÃˆNCIES CIENTÃFIQUES</strong> que demostrin que les ones electromagnÃ¨tiques del WiFi, del mÃ²bil o de les antenes de telefonia causin <strong>CÃ€NCER</strong> o qualsevol altra malaltia.</i></p>', '<p><i>â€œEl mÃ²bil i el WiFi emeten <strong>RADIACIÃ“ ELECTROMAGNÃˆTICA</strong>.</i><br><i>Potser aquesta frase et sona malament perquÃ¨ contÃ© la paraula&nbsp;<strong>RADIACIÃ“</strong>, perÃ² aixÃ² nomÃ©s significa que emeten un tipus dâ€™energia en <strong>Lâ€™ESPECTRE ELECTROMAGNÃˆTIC</strong>, concretament en la regiÃ³ de <strong>RADIOFREQÃœÃˆNCIA</strong> o de <strong>MICROONES</strong>.</i></p><p><i>Les ones tenen una&nbsp;<strong>FREQÃœÃˆNCIA</strong> directament relacionada amb la seva&nbsp;<strong>ENERGIA</strong>: Les ones de rÃ dio, les microones, la llum infraroja i la llum visible sÃ³n formes de <strong>RADIACIÃ“&nbsp;NO IONITZANT</strong>. AixÃ² signficia que no tenen suficient freqÃ¼Ã¨ncia per trencar enllaÃ§os entre els <strong>Ã€TOMS</strong>, que Ã©s el que pot causar problemes seriosos de <strong>SALUT</strong>.</i></p><p><i>No existeixen&nbsp;<strong>EVIDÃˆNCIES CIENTÃFIQUES</strong> que demostrin que les ones electromagnÃ¨tiques del WiFi, del mÃ²bil o de les antenes de telefonia causin <strong>CÃ€NCER</strong> o qualsevol altra malaltia.</i></p><p><i>No obstant aixÃ², encara que el consens cientÃ­fic Ã©s que sÃ³n segurs, lâ€™OrganitzaciÃ³ Mundial de la Salut (<strong>OMS</strong>), classifica els camps electromagnÃ¨tics de radiofreqÃ¼Ã¨ncia com a <strong>AGENTS CARCINÃ’GENS</strong> de categoria 2B, â€œpossiblement carcinÃ²gens per als humansâ€.</i></p><p>Bruno MartÃ­n</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>Tecnologies militars</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>Tecnologia militar <a href=\"https://es.wikipedia.org/wiki/Tecnolog%C3%ADa_militar\">https://es.wikipedia.org/wiki/Tecnolog%C3%ADa_militar</a></li><li>Bombes de dispersiÃ³ <a href=\"https://ca.wikipedia.org/wiki/Bomba_de_dispersi%C3%B3\">https://ca.wikipedia.org/wiki/Bomba_de_dispersiÃ³</a></li><li>Projectes militars innovadors <a href=\"https://retina.elpais.com/retina/2020/01/02/innovacion/1577970082_194200.html\">https://retina.elpais.com/retina/2020/01/02/innovacion/1577970082_194200.html</a></li><li>Tecnologia militar futurista <a href=\"https://www.elconfidencial.com/tecnologia/2019-05-31/tecnologia-militar-drones-blindados_2044610/\">https://www.elconfidencial.com/tecnologia/2019-05-31/tecnologia-militar-drones-blindados_2044610/</a></li><li>NotÃ­cies de defensa, exÃ¨rcit, armament, etc. <a href=\"https://www.defensa.com/\">https://www.defensa.com</a></li></ul>', '<p>Una <i><strong>BOMBA DE DISPERSIÃ“</strong></i> Ã©s una municiÃ³ de caiguda lliure que quan es llanÃ§a des de lâ€™aire i assoleix certa alÃ§ada, desprÃ¨n petites bombes dâ€™alt poder explosiu.</p>', '<p>Una <i><strong>BOMBA DE DISPERSIÃ“</strong></i> Ã©s una municiÃ³ de caiguda lliure que quan es llanÃ§a des de lâ€™aire i assoleix certa alÃ§ada, desprÃ¨n petites bombes dâ€™alt poder explosiu. Cada bomba pot arribar a desprendre mÃ©s de 200 cÃ rregues explosives en un radi dâ€™uns 400 metres aproximadament, lâ€™equivalent a quatre camps de futbol, on queden espargides.</p><p>Les bombes llanÃ§ades poden quedar enterrades sense explotar, sent perilloses temps desprÃ©s de lâ€™atac i generant un impacte negatiu en la humanitat; generen residus explosius de guerra (REG) que sÃ³n inestables i de llarga duraciÃ³.</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>Tecnologies nuclears</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>DefiniciÃ³ <a href=\"https://ca.wikipedia.org/wiki/Energia_nuclear\">https://ca.wikipedia.org/wiki/Energia_nuclear</a></li><li>Lâ€™energia nuclear <a href=\"https://www.csn.es/la-energia-nuclear\">https://www.csn.es/la-energia-nuclear</a></li><li>FÃ²rum nuclear <a href=\"https://www.foronuclear.org/es/\">https://www.foronuclear.org/es/</a></li><li>Aplicacions <a href=\"https://energia-nuclear.net/aplicaciones\">https://energia-nuclear.net/aplicaciones</a></li><li>Aplicacions â€œpacÃ­fiquesâ€ <a href=\"https://www.muyinteresante.es/ciencia/articulo/aplicaciones-pacificas-de-la-energia-nuclear\">https://www.muyinteresante.es/ciencia/articulo/aplicaciones-pacificas-de-la-energia-nuclear</a></li><li>Altres aplicacions <a href=\"http://www.nupecc.org/NUPEX/index.php?g=textcontent/nuclearenergy/otherusesofnuclear&amp;lang=es\">http://www.nupecc.org/NUPEX/index.php?g=textcontent/nuclearenergy/otherusesofnuclear&amp;lang=es</a></li><li>Per quÃ¨ alguns paÃ¯sos recolzen lâ€™energia nuclear? <a href=\"http://www.energiaysociedad.es/porque-algunos-paises-apoyan-la-energia-nuclear/\">http://www.energiaysociedad.es/porque-algunos-paises-apoyan-la-energia-nuclear/</a></li></ul>', '<p>Lâ€™<strong>ENERGIA NUCLEAR</strong> Ã©s lâ€™energia continguda en el nucli dâ€™un Ã tom.</p>', '<p>Lâ€™<strong>ENERGIA NUCLEAR</strong> Ã©s lâ€™energia continguda en el nucli dâ€™un Ã tom.</p><p>Els Ã toms sÃ³n les partÃ­cules mÃ©s petites en quÃ¨ pot dividir-se un element quÃ­mic mantenint les seves propietats. En el nucli de cada Ã tom hi ha dos tipus de partÃ­cules (neutrons i protons) que es mantenen unides.</p><p>Lâ€™energia nuclear Ã©s lâ€™energia que mantÃ© units neutrons i protons.</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>ObsolescÃ¨ncia programada</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>DefiniciÃ³ <a href=\"https://ca.wikipedia.org/wiki/Obsolesc%C3%A8ncia_planificada\">https://ca.wikipedia.org/wiki/ObsolescÃ¨ncia_planificada</a></li><li>Resum documental â€œComprar, tirar, comprarâ€ <a href=\"https://www.youtube.com/watch?v=pgX1iqrwE8I\">https://www.youtube.com/watch?v=pgX1iqrwE8I</a></li><li>Documental complert â€œComprar, tirar, comprarâ€ <a href=\"https://www.youtube.com/watch?v=uGAghAZRMyU\">https://www.youtube.com/watch?v=uGAghAZRMyU</a></li></ul>', '<p>Lâ€™<i><strong>OBSOLESCÃˆNCIA PROGRAMADA</strong></i> o <i><strong>OBSOLESCÃˆNCIA PLANIFICADA</strong></i> Ã©s la planificaciÃ³ de la fi de la vida Ãºtil dâ€™un producte o servei</p>', '<p>Lâ€™<i><strong>OBSOLESCÃˆNCIA PROGRAMADA</strong></i> o <i><strong>OBSOLESCÃˆNCIA PLANIFICADA</strong></i> Ã©s la planificaciÃ³ de la fi de la vida Ãºtil dâ€™un producte o servei, de manera que aquest es torni obsolet o inservible al cap dâ€™un perÃ­ode calculat per endavant pel fabricant o empresa de serveis, durant la fase de disseny del producte o servei.</p><p>â€œ<i>Comprar, tirar,<strong> </strong>comprar</i>â€œ</p><p>Ã‰s el tÃ­tol del revelador documental de Cosima Dannoritzer. Estrenat el 2010, explica la histÃ²ria secreta de lâ€™obsolescÃ¨ncia programada; Ã©s a dir, el disseny de productes orientat, de manera deliberada, a escurÃ§ar la seva vida Ãºtil i incentivar aixÃ­ el consum.</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>Impacte mediambiental de les noves&nbsp;tecnologies</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>Samsung Galaxy Note 7 emprat com a bomba al joc de GTA V <a href=\"https://www.lavanguardia.com/tecnologia/videojuegos/20161005/41793254150/samsung-galaxy-note-gta-bomba-mod.html\">https://www.lavanguardia.com/tecnologia/videojuegos/20161005/41793254150/samsung-galaxy-note-gta-bomba-mod.html</a></li><li>PerquÃ¨ van explotar alguns dels mÃ²bils Samsung Galaxy Note 7 <a href=\"https://www.xataka.com/moviles/samsung-confirma-que-las-explosiones-del-galaxy-note-7-fueron-por-baterias-defectuosas-y-una-fabricacion-apresurada\">https://www.xataka.com/moviles/samsung-confirma-que-las-explosiones-del-galaxy-note-7-fueron-por-baterias-defectuosas-y-una-fabricacion-apresurada</a></li><li>ExplosiÃ³ dâ€™un telÃ¨fon mÃ²bil Samsung en un aviÃ³ <a href=\"https://www.bbc.com/mundo/noticias-37573679\">https://www.bbc.com/mundo/noticias-37573679</a></li><li>Possibles causes dâ€™explosiÃ³ de telÃ¨fons mÃ²bils en avions <a href=\"https://www.bbc.com/mundo/noticias-45057721\">https://www.bbc.com/mundo/noticias-45057721</a></li><li>Reciclar el Liti de les bateries de Liti <a href=\"https://www.quo.es/ciencia/a73693/reciclar-el-litio-de-las-baterias/\">https://www.quo.es/ciencia/a73693/reciclar-el-litio-de-las-baterias/</a></li><li>Reciclatge de les bateries de Liti i el Cobalt de bateries esgotades <a href=\"https://iambiente.es/2019/04/un-nuevo-descubrimiento-permite-reciclar-el-litio-y-el-cobalto-de-las-baterias-gastadas/\">https://iambiente.es/2019/04/un-nuevo-descubrimiento-permite-reciclar-el-litio-y-el-cobalto-de-las-baterias-gastadas/</a></li></ul>', '<p>a <strong>bateria de Liti</strong> o <strong>bateria Li-Ion</strong>, Ã©s un dispositiu pensat per emmagatzemar energia elÃ¨ctrica.</p>', '<p>La <strong>bateria de Liti</strong> o <strong>bateria Li-Ion</strong>, Ã©s un dispositiu pensat per emmagatzemar energia elÃ¨ctrica.</p><p>Empra com a electrÃ²lit una sal de liti que proporciona ions per a la reacciÃ³ electro-quÃ­mica que tÃ© lloc entre el cÃ tode i lâ€™Ã node. Aquest tipus de bateria fa servir reaccions electro-quÃ­miques per produir un corrent elÃ¨ctric, disposa dâ€™una alta densitat de cÃ rrega i per tant, Ã©s de llarga durada.</p><p>Cal mencionar, que gran part dels materials que componen les bateries de Liti (Ex. Ã²xid de polietilÃ¨ o poliacrilonitril) no es recuperen i el seu procÃ©s de reciclatge presenta riscos ambientals.</p><p>Per altre costat, la seva sensibilitat a elevades temperatures, pot provocar que sâ€™espatllin per inflamaciÃ³ o bÃ© explosiÃ³. Per aquesta raÃ³, en la seva fabricaciÃ³ necessiten dispositius addicionals de seguretat, convertint-les en un dispositiu de cost elevat.</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>FabricaciÃ³ digital</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>InformaciÃ³ sobre impressiÃ³ 3D <a href=\"https://www.3dnatives.com/es/\">https://www.3dnatives.com/es/</a></li><li>FabricaciÃ³ dâ€™armes amb impressores 3D <a href=\"https://www.3dnatives.com/es/europa-impresion-de-armas-de-fuego-en-3d-260620192/\">https://www.3dnatives.com/es/europa-impresion-de-armas-de-fuego-en-3d-260620192/</a></li><li>Respiradors 3D COVID-19 <a href=\"https://www.3dnatives.com/es/conector-impreso-en-3d-suministrar-oxigeno-080420202/\">https://www.3dnatives.com/es/conector-impreso-en-3d-suministrar-oxigeno-080420202/</a></li><li>Ateneus de fabricaciÃ³. Barcelona <a href=\"https://ajuntament.barcelona.cat/digital/ca/apoderament-digital/educacio-i-capacitacio-digital/ateneus-de-fabricacio\">https://ajuntament.barcelona.cat/digital/ca/apoderament-digital/educacio-i-capacitacio-digital/ateneus-de-fabricacio</a></li><li>Programa pedagÃ²gic Ateneus de fabricaciÃ³ <a href=\"https://www.edubcn.cat/ca/suport_educatiu_recursos/plans_programes/laboratori_de_fabricacio\">https://www.edubcn.cat/ca/suport_educatiu_recursos/plans_programes/laboratori_de_fabricacio</a></li><li>COVID-19. Preguntes i respostes <a href=\"https://www.aspb.cat/noticies/preguntes-respostes-covid19/\">https://www.aspb.cat/noticies/preguntes-respostes-covid19/</a></li></ul>', '<p>Lâ€™any <strong>2019</strong>, un estudiant de la South Bank University de Londres, va ser detingut per elaborar armes mitjanÃ§ant una impressora 3D a casa seva.</p>', '<p>Lâ€™any <strong>2019</strong>, un estudiant de la South Bank University deLondres, va ser detingut per elaborar armes mitjanÃ§antuna impressora 3D a casa seva. El jove es troba subjecte a una sentÃ¨ncia de 5 anys de presÃ³ per possessiÃ³ dâ€™armament de foc prohibit.</p><p>Lâ€™any <strong>2020</strong>, la companyia belga Materialise desenvolupa una nova soluciÃ³ per combatre el Covid-19. Un connector imprÃ¨s en 3D que permet vincular una mascareta de ventilaciÃ³ no invasiva, un filtre i una vÃ lvula. Quan aquests tres elements es combinen subministren oxigen i creen una alta pressiÃ³ positiva sense lâ€™Ãºs de ventilador. Dâ€™aquesta manera, es proporciona una soluciÃ³ dâ€™emergÃ¨ncia als hospitals que necessiten dispositius respiratoris.</p>');
INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) VALUES ('<h2><strong>AddicciÃ³ a les&nbsp;pantalles</strong></h2>', '<p>Si vols saber-ne mÃ©sâ€¦</p><ul><li>DefiniciÃ³ NomofÃ²bia <a href=\"https://ca.wikipedia.org/wiki/Nomof%C3%B2bia\">https://ca.wikipedia.org/wiki/NomofÃ²bia</a></li><li>Recomanacions AssociaciÃ³ Americana de Pediatria <a href=\"https://www.aap.org/en-us/about-the-aap/aap-press-room/news-features-and-safety-tips/Pages/Children-and-Media-Tips.aspx\">https://www.aap.org/en-us/about-the-aap/aap-press-room/news-features-and-safety-tips/Pages/Children-and-Media-Tips.aspx</a></li><li>Aplicacions per controlar lâ€™Ãºs del telÃ¨fon mÃ²bil <a href=\"https://byzness.elperiodico.com/es/innovadores/20190616/apps-controlar-tiempo-movil-7507247\">https://byzness.elperiodico.com/es/innovadores/20190616/apps-controlar-tiempo-movil-7507247</a></li><li>Dossier de recursos i documents sobre lâ€™AddicciÃ³ a les pantalles <a href=\"https://dixit.gencat.cat/ca/detalls/Article/20180723_addiccions_pantalles\">https://dixit.gencat.cat/ca/detalls/Article/20180723_addiccions_pantalles</a></li><li>Programa Desconnecta <a href=\"https://www.programadesconecta.com/es/sobre-desconecta/actualitat/\">https://www.programadesconecta.com/es/sobre-desconecta/actualitat/</a></li><li>Diferenciar lâ€™addicciÃ³ de lâ€™Ãºs abusiu <a href=\"https://theconversation.com/como-diferenciar-entre-adiccion-a-las-pantallas-y-uso-abusivo-en-ninos-y-adolescentes-126789\">https://theconversation.com/como-diferenciar-entre-adiccion-a-las-pantallas-y-uso-abusivo-en-ninos-y-adolescentes-126789</a></li></ul>', '<p>La <strong>NOMOFÃ’BIA</strong> Ã©s la por irracional a romandre un interval de temps sense el telÃ¨fon mÃ²bil. El terme, que Ã©s un acrÃ²nim de lâ€™expressiÃ³ anglesa â€œ<i>no-mobile-phone phobia</i>â€œ.</p>', '<p>La <strong>NOMOFÃ’BIA</strong> Ã©s la por irracional a romandre un interval de temps sense el telÃ¨fon mÃ²bil. El terme, que Ã©s un acrÃ²nim de lâ€™expressiÃ³ anglesa â€œ<i>no-mobile-phone phobia</i>â€œ.</p><p>Lâ€™<strong>AssociaciÃ³ Americana de Pediatria</strong> (APP) estableix:</p><p>En nadons de fins a 18 mesos, hem dâ€™evitar lâ€™exposiciÃ³ a les pantalles.</p><p>Dels 2 als 5 anys sâ€™ha de limitar lâ€™Ãºs dels mitjans entre mitjana i una hora al dia, sempre que els continguts siguin dâ€™alta qualitat.</p><p>Des dels 5 als 12 anys Ã©s necessari acompanyar-los i supervisar-los sempre, podent estar entre una hora o hora i mitja al dia.</p><p>Amb lâ€™<strong>adolescÃ¨ncia</strong>, la nostra labor ha de ser mÃ©s la de guiar-los i educar-los en lâ€™<strong>Ãºs responsable i saludable</strong> de les tecnologies.</p>');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','1','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Quines necessitats hauria de satisfer un vehicle totalment autònom? ','1','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Quins aspectes haurien estudiar sobre les accions que realitza un vehicle autònom? ','1','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Com hauríem de programar un vehicle autònom per decidir què fer i com actuar en una situació de risc?','1','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Visita la següent pàgina web: www.moralmachine.mit.edu En ella es plantegen dilemes ètics i morals relacionats amb els vehicles autònoms.','1','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Realitza el test proposat, descarrega els teus propis resultats i valora','1','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a aula. Conclusions sobre els avantatges i inconvenients dels vehicles autònoms.','1','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','2','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Coneixies la relació entre les radiacions electromagnètiques i la salut? Quina és la teva opinió?','2','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Què és un agent carcinògen? implica l\'aparició segura d\'un càncer?','2','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Desconnectes el wifi del teu telèfon mòbil quan vas a dormir? Per què?','2','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Investiga dos objectes tecnològics que es puguin considerar pseudotecnologia','2','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre l\'existència de la pseudotecnologia','2','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','3','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Et consideraries a favor o en contra de les tecnologies militars?','3','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Creus que les tecnologies militars han afavorit algun aspecte de la nostra vida quotidiana?','3','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Un cop visualitzat el vídeo d\'una de les escenes de la pel·lícula IRON MAN...','3','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Investiga els efectes negatius que han tingut les bombes de dispersió. Perquè creus que alguns països no van signar un acord per a prohibir la seva proliferació?','3','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('El propietari d\'Indústries Stark es dedica a la creació i distribució d\'armament militar, té un moment de reflexió durant la pel·lícula on es planteja canviar l\'objectiu de la seva empresa. A què creus que es deu aquest fet?','3','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre la producció de tecnologies militars.','3','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','4','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Estàs a favor o en contra de la rpoducció d\'energia nuclear? Creus que podríem viure sense l\'energia nuclear?','4','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('La figura anterior la signa el \"Foro nuclear\". Creus que és informació fiable? Té algun tipus d\'interès en el proliferament de l\'energia nuclear? Investiga aquesta entitat','4','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Endinsa\'t dins la web de l\'agència de residus de Catalunya.','4','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Com reciclaries aquest tipus de residu?','4','ol');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre els avantatges i els incovenients de la producció d\'energia nuclear','4','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','5','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Havies sentit parlar prèviament sobre l\'obsolescència programada? A on?','5','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Estàs a favor o en contra de l\'obsolescència programada? Per què?','5','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Has sospitat alguna vegada ser víctima de l\'obsolescència programada? Quan?','5','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Quines idees et venen al cap per millorar l\'economia sense haver de recórrer a l\'obsolescència programada?','5','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre els avantatges i inconvenients de l\'obsolescència programada.','5','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','6','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Havies sentit a parlar sobre la notícia adjuntada? Quina va ser/ha estat la teva reacció al llegir-la?','6','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Quins objectes fas servir a la teva vida quotidiana que puguin contenir bateries de liti? Com ho pots saber?','6','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Quina Alternativa escològica proposaries a l\'us de bateries de liti que presenti un menor impacte mediambiental','6','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Investiga com es reciclen aquest tipus de bateries i fes una breu presentació de Diapositives','6','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre l\'impacte mediambiental de les noves tecnologies.','6','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','7','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('De quina manera gestionaries la comercialització d\'impressores 3D en la societat per a garantir un bon ús d\'aquestes?','7','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Realitza un llistat dels avantatges i inconvenients que creus va generar l\'aparició de la impressió 3D','7','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Fes una recerca dels materials que es fan servir per la impressió 3D. Són tots biodegradables? Com es gestiona el seu reciclatge?','7','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Com has pogut veure, la impressió 3D té moltes possibilitats d\'aplicació i aquestes poden ser molt diverses. Investiga a la xarxa i proposa una aplicació que resolgui un problema i/o necessitat. Fes una breu descripció i un croquis de com hauria de ser el seu disseny','7','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre els avantatges i inconvenients de la impressió 3D.','7','p');

INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Reflexiona sobre les següents preguntes i raona la teva resposta','8','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Fes una recerca sobre els símptomes que presenta la Nomofòbia. Realitza un llistat i indica amb quin d\'ells t\'hi has sentit identificat algun cop i en quin moment','8','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Què prefereixes fer a les teves estones lliures, agafar un llibre o agafar el mòbil/ordinador/televisió? Per què?','8','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Hi ha diverses recomanacions sobre l\'ús de pantalles per no perjudicar la salut. Fes un llistat sobre els perjudicis que creus que té passar un llarg període de temps davant d\'una pantalla.','8','ul');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Existeixen diverses aplicacions que controlen el temps d\'ús que passem amb els telèfons mòbils per obtenir una millora del benestar. Descarrega\'t una de les aplicacions proposades i registra els teus resultats durant una setmana, valora\'ls i realitza un document explicatiu d\aquests donant la teva opinió personal. *En cas de no tenir telèfon propi, proposa l\'experiment a un familiar.','8','p');
INSERT INTO pregunta (texto_pregunta, id_dilema, tipo_numeracion) VALUES ('Posada en comú a l\'aula. Conclusions sobre els perjudicis que pot causar l\'ús de pantalles durant períodes de llarga durada.','8','p');

"

#Users
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'password';"
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'password';"
sed -i 's/^bind-address/#bind-address/' /etc/mysql/my.cnf
sed -i 's/^skip-external-locking/#skip-external-locking/' /etc/mysql/my.cnf
sudo service mysql restart

# Copiar archivos de conf
cp /vagrant/my.cnf /etc/mysql/my.cnf

# Install composer
curl -sS http://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Run composer install
cd /vagrant && composer install --dev

# Run migrations
php /vagrant/artisan migrate --seed

# Change apache document root
sed -i 's/index.html/Login.php/g' /etc/apache2/mods-available/dir.conf
sudo service apache2 restart
