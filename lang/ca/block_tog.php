<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin strings in Catalan are defined here.
 *
 * @package block_tog
 * @category string
 * @copyright 2018 - 2020 UDT-IA, IIIA-CSIC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined( 'MOODLE_INTERNAL' ) || die();

$string ['pluginname'] = 'Bloc per fer grups orientatas a tasques';
$string ['tog'] = 'Groups orientats a tasques';

$string ['settings:heading'] = 'Un bloc de Moodle per agrupar usuaris segons la tasca a realitzar. Els grups formats tenen diversitat de gènere, personalitat i intel·ligència.';
$string ['settings:base_api_url_title'] = 'Base API URL';
$string ['settings:base_api_url_description'] = 'L\'URL al servei exterior que generarà els grups per a una tasca. El servei que proporcionem (https://eduteams.iiia.csic.es/saas/) és gratuït sense cap limitació. Malauradament, tenim alguns límits físics en el servidor que només pot processar milers de sol·licituds per segon. Quan s\'utilitza el servei, emmagatzema la informació de l\'encapçalament HTTP com l\'adreça o el port remot, el nombre d\'estudiants per grup, els requeriments d\'intel·ligències per la tasca, el rendiment esperat per als grups i la llista d\'estudiants. Per a cada estudiant s\'emmagatzema un identificador i la seva personalitat i intel·ligència associades. L\'identificador està anonimitzat per la qual cosa el servei no coneix informació de la persona definida a Moodle. A més, emmagatzema els grups formats per als estudiants. D\'altra banda, emmagatzema els comentaris aportats pels professors quan avalua el rendiment dels grups formats.';

$string ['main:composite'] = 'Creeu un grup nou per tasca';
$string ['main:fill_personality_test'] = 'Ompliu la vostra prova de personalitat';
$string ['main:my_personality'] = 'La meva personalitat';
$string ['main:my_intelligences'] = 'Les meves intel·ligències';
$string ['main:fill_intelligences_test'] = 'Completeu la vostra prova d\'intel·ligències';
$string ['main:auto_fill_in'] = 'Auto completa els tests';
$string ['main:feedback_test'] = 'Proporcioneu comentaris sobre els grups creats';

$string ['personality_test_title'] = 'Prova de personalitat';
$string ['personality_test_heading'] = 'Prova de personalitat';
$string ['personality_test_go_to_personality'] = 'Mostra la meva personalitat';
$string ['personality_test_go_to_course'] = 'Tornar al curs';
$string ['personality_test_go_to_intelligences_test'] = 'Omplir prova d\'intel·ligències';
$string ['personality_test_storing_msg'] = 'Guardando respuesta';

$string ['personality_question_0'] = 'Jo sóc';
$string ['personality_question_0_answer_0'] = 'Dona';
$string ['personality_question_0_answer_1'] = 'Home';
$string ['personality_question_0_answer_2'] = 'Prefereixo no contestar';

$string ['personality_question_1'] = 'Els jutges han de ser';
$string ['personality_question_1_help'] = 'Exemple: Si un jutge jutja al teu germà, ha de seguir les lleis que valen per a tots per igual.';
$string ['personality_question_1_answer_0'] = 'Compasius';
$string ['personality_question_1_answer_1'] = 'Imparcials';
$string ['personality_question_1_answer_2'] = 'Depèn del cas';

$string ['personality_question_2'] = 'Prefereixes les coses';
$string ['personality_question_2_help'] = 'Exemple: M\'agrada planejar el meu dia a dia o prefereixo improvisar.';
$string ['personality_question_2_answer_0'] = 'Obertes';
$string ['personality_question_2_answer_1'] = 'Planificades';
$string ['personality_question_2_answer_2'] = 'Indiferent';

$string ['personality_question_3'] = 'Prefereixes';
$string ['personality_question_3_answer_0'] = 'El tradicional';
$string ['personality_question_3_answer_1'] = 'El nou';
$string ['personality_question_3_answer_2'] = 'Indiferent';

$string ['personality_question_4'] = 'Prefereixes';
$string ['personality_question_4_answer_0'] = 'Estar sol';
$string ['personality_question_4_answer_1'] = 'Estar acompanyat';
$string ['personality_question_4_answer_2'] = 'Indiferent';

$string ['personality_question_5'] = 'Ets més';
$string ['personality_question_5_help'] = 'Exemple: Creus en les coses que et diuen o prefereixes comprovar-ho.';
$string ['personality_question_5_answer_0'] = 'Tolerant';
$string ['personality_question_5_answer_1'] = 'Escèptic';
$string ['personality_question_5_answer_2'] = 'Indiferent';

$string ['personality_question_6'] = 'Treballes millor';
$string ['personality_question_6_answer_0'] = 'Sense pressió';
$string ['personality_question_6_answer_1'] = 'Amb pressió';
$string ['personality_question_6_answer_2'] = 'Indiferent';

$string ['personality_question_7'] = 'Ets més';
$string ['personality_question_7_help'] = 'Exemple: Quan faig els deures, m\'agrada organitzar-pas a pas sempre en el mateix ordre o prefereixo començar a l\'atzar.';
$string ['personality_question_7_answer_0'] = 'Metòdic';
$string ['personality_question_7_answer_1'] = 'Improvisador';
$string ['personality_question_7_answer_2'] = 'Indiferent';

$string ['personality_question_8'] = 'Ets més';
$string ['personality_question_8_help'] = 'Exemple: M\'agraden més les matemàtiques (teòric) o educació física (pràctic).';
$string ['personality_question_8_answer_0'] = 'Teòric';
$string ['personality_question_8_answer_1'] = 'Pràctic';
$string ['personality_question_8_answer_2'] = 'Indiferent';

$string ['personality_question_9'] = 'Ets més';
$string ['personality_question_9_help'] = 'Exemple: M\'agrada explicar-li tot a que em passa als meus amics o prefereixo guardarmelo per a mi.';
$string ['personality_question_9_answer_0'] = 'Reservat';
$string ['personality_question_9_answer_1'] = 'Sociable';
$string ['personality_question_9_answer_2'] = 'Indiferent';

$string ['personality_question_10'] = 'Et veus a tu mateix més';
$string ['personality_question_10_help'] = 'Exemple: Prefereixes construir un robot (Curiós) o comprar-lo ja fet (Acomodat).';
$string ['personality_question_10_answer_0'] = 'Acomodat';
$string ['personality_question_10_answer_1'] = 'Curiós';
$string ['personality_question_10_answer_2'] = 'Indiferent';

$string ['personality_question_11'] = 'Ets més';
$string ['personality_question_11_answer_0'] = 'Contingut';
$string ['personality_question_11_answer_1'] = 'Expressiu';
$string ['personality_question_11_answer_2'] = 'Indiferent';

$string ['personality_question_12'] = 'Ets més';
$string ['personality_question_12_help'] = 'Exemple: Dic les coses com són (honest) o prefereixo ometre les paraules que puguin ferir.';
$string ['personality_question_12_answer_0'] = 'Diplomàtic';
$string ['personality_question_12_answer_1'] = 'Honest';
$string ['personality_question_12_answer_2'] = 'Indiferent';

$string ['personality_question_13'] = 'Prefereixes';
$string ['personality_question_13_help'] = 'Exemple: Prefereixes fer mapes (el concret) o resoldre problemes matemàtics (l\'abstracte).';
$string ['personality_question_13_answer_0'] = 'El concret';
$string ['personality_question_13_answer_1'] = 'L\'abstracte';
$string ['personality_question_13_answer_2'] = 'Indiferent';

$string ['personality_question_14'] = 'Ets més';
$string ['personality_question_14_answer_0'] = 'Silenciós';
$string ['personality_question_14_answer_1'] = 'Xarraire';
$string ['personality_question_14_answer_2'] = 'Indiferent';

$string ['personality_question_15'] = 'Aprens millor';
$string ['personality_question_15_answer_0'] = 'Llegint';
$string ['personality_question_15_answer_1'] = 'Escoltant';
$string ['personality_question_15_answer_2'] = 'Indiferent';

$string ['personality_question_16'] = 'Ets més';
$string ['personality_question_16_help'] = 'Exemple: T\'agrada pensar per què volen els avions (conceptual) o fer una maqueta d\'un avió (pràctic)';
$string ['personality_question_16_answer_0'] = 'Pràctic';
$string ['personality_question_16_answer_1'] = 'Conceptual';
$string ['personality_question_16_answer_2'] = 'Indiferent';

$string ['personality_question_17'] = 'Prefereixes';
$string ['personality_question_17_help'] = 'Exemple: Si el teu amic arriba 20 minuts tard, vols saber per què (empatia) o t\'enfades sense importar el motiu (lògica).';
$string ['personality_question_17_answer_0'] = 'Empatia';
$string ['personality_question_17_answer_1'] = 'Lògica';
$string ['personality_question_17_answer_2'] = 'Indiferent';

$string ['personality_question_18'] = 'Prefereixes';
$string ['personality_question_18_help'] = 'Exemple: Quan hi ha un robatori prefereixo investigar els fets o imaginar el que ha pogut passar.';
$string ['personality_question_18_answer_0'] = 'Investigar';
$string ['personality_question_18_answer_1'] = 'Especular';
$string ['personality_question_18_answer_2'] = 'Indiferent';

$string ['personality_question_19'] = 'Ets més';
$string ['personality_question_19_help'] = 'Exemple: Quan em preparo per anar a dormir, sempre segueixo el mateix ordre (rentar dents, posar pijama etc).';
$string ['personality_question_19_answer_0'] = 'Sistemàtic';
$string ['personality_question_19_answer_1'] = 'Informal';
$string ['personality_question_19_answer_2'] = 'Indiferent';

$string ['personality_question_20'] = 'Prefereixes';
$string ['personality_question_20_help'] = 'Exemple: M\'agrada menjar coses diferents (varietat) o prefereixo menjar sempre pizza (rutina).';
$string ['personality_question_20_answer_0'] = 'Rutina';
$string ['personality_question_20_answer_1'] = 'Varietat';
$string ['personality_question_20_answer_2'] = 'Indiferent';

$string ['intelligences_test_title'] = 'Prova d\'intel·ligències';
$string ['intelligences_test_heading'] = 'Prova d\'intel·ligències';
$string ['intelligences_test_go_to_intelligences'] = 'Mostra les meves intel·ligències';
$string ['intelligences_test_go_to_course'] = 'Tornar al curs';
$string ['intelligences_test_go_to_personality_test'] = 'Omplir prova de personalitat';
$string ['intelligences_test_storing_msg'] = 'Guardando respuesta';

$string ['intelligence_question_0'] = 'Escriure és una manera natural per a que jo m\' expressi';
$string ['intelligence_question_answer_0'] = 'Totalment en desacord';
$string ['intelligence_question_answer_1'] = 'En desacord';
$string ['intelligence_question_answer_2'] = 'Ni d\'acord ni en desacord';
$string ['intelligence_question_answer_3'] = 'D\'acord';
$string ['intelligence_question_answer_4'] = 'Totalment d\'acord';

$string ['intelligence_question_1'] = 'En els estudis escolars en llengua materna o estudis socials foren més fàcils per a mi que les matemàtiques, la física i la química.';

$string ['intelligence_question_2'] = 'Recentment he escrit alguna cosa d\'allò que estic especialment orgullós, o pel que he rebut reconeixement.';

$string ['intelligence_question_3'] = 'Les metàfores i les expressions verbals viscudes m\' ajuden a aprendre eficientment.';

$string ['intelligence_question_4'] = 'A l\'escola era bo en matemàtiques, física o química.';

$string ['intelligence_question_5'] = 'Puc treballar amb i resoldre problemes complexos.';

$string ['intelligence_question_6'] = 'L\'aritmètica mental és fàcil per a mi.';

$string ['intelligence_question_7'] = 'Sóc bo en jocs i resolució de problemes, que requereixen de pensament lògic.';

$string ['intelligence_question_8'] = 'A l\'escola, la geometria i diversos tipus de tasques que involucren la percepció espacial van ser més fàcils per a mi que resoldre equacions.';

$string ['intelligence_question_9'] = 'És fàcil per a mi conceptualitzar patrons complexos i multidimensionals.';

$string ['intelligence_question_10'] = 'Puc imaginar fàcilment com un paisatge mira des d\'una vista d\'ocell.';

$string ['intelligence_question_11'] = 'Quan llego, formo imatges o dissenys il·lustratius a la meva ment.';

$string ['intelligence_question_12'] = 'Sóc molt pràctic.';

$string ['intelligence_question_13'] = 'Puc fàcilment fer alguna cosa concreta amb les meves mans (per exemple, teixir i treballar en fusta).';

$string ['intelligence_question_14'] = 'Sóc bo en mostrar com fer alguna cosa a la pràctica.';

$string ['intelligence_question_15'] = 'Jo era bo a l\'artesania a l\'escola.';

$string ['intelligence_question_16'] = 'Després d\'escoltar una melodia una o dues vegades sóc capaç de cantar o silbar amb prou precisió.';

$string ['intelligence_question_17'] = 'En escoltar música, sóc capaç de discernir instruments o reconèixer melodies.';

$string ['intelligence_question_18'] = 'Puc mantenir fàcilment el ritme en tocar una melodia.';

$string ['intelligence_question_19'] = 'Em dono compte d\'immediat si una melodia està desafinada.';

$string ['intelligence_question_20'] = 'Fins i tot en companyia estranya, fàcilment trobo a algú amb qui parlar.';

$string ['intelligence_question_21'] = 'Em aconsegueixo sola fàcilment amb diferents tipus de persones.';

$string ['intelligence_question_22'] = 'Faig contacte fàcilment amb altres persones.';

$string ['intelligence_question_23'] = 'En les negociacions i el treball en grup, sóc capaç de recolzar el grup per trobar un consens.';

$string ['intelligence_question_24'] = 'Sóc capaç d\'analitzar els meus propis motius i formes d\'acció.';

$string ['intelligence_question_25'] = 'Sovint penso en els meus propis sentiments i sentiments i busco raons per a ells.';

$string ['intelligence_question_26'] = 'Dedico temps a reflexionar regularment sobre els temes importants de la vida.';

$string ['intelligence_question_27'] = 'M\'agrada llegir literatura psicològica o filosòfica per augmentar el meu autoconeixement.';

$string ['intelligence_question_28'] = 'Gaudiu de la bellesa i les experiències relacionades amb la natura.';

$string ['intelligence_question_29'] = 'Protegir la natura és important per a mi.';

$string ['intelligence_question_30'] = 'Presto atenció als meus hàbits de consum amb la finalitat de protegir el medi ambient.';

$string ['store_personality_answer_error_title'] = 'Error';
$string ['store_personality_answer_error_text'] = 'No puc emmagatzemar la teva resposta personal.';
$string ['store_personality_answer_error_continue'] = 'D\'acord';

$string ['store_intelligences_answer_error_title'] = 'Error';
$string ['store_intelligences_answer_error_text'] = 'No puc emmagatzemar la resposta de les intel·ligències.';
$string ['store_intelligences_answer_error_continue'] = 'D\'acord';

$string ['privacy:metadata:block_tog_perso_answers'] = 'Informació sobre les respostes de l\'usuari a les preguntes de la prova de personalitat.';
$string ['privacy:metadata:block_tog_perso_answers:userid'] = 'La identificació de l\'usuari que respon a la pregunta.';
$string ['privacy:metadata:block_tog_perso_answers:question'] = 'L\'identificador de la pregunta.';
$string ['privacy:metadata:block_tog_perso_answers:answer'] = 'L\'identificador de la resposta a la pregunta.';
$string ['privacy:export:block_tog_perso_answers'] = 'Prova de personalitat';

$string ['privacy:metadata:block_tog_intel_answers'] = 'Informació sobre les respostes de l\'usuari a les preguntes de prova d\'intel·ligències.';
$string ['privacy:metadata:block_tog_intel_answers:userid'] = 'La identificació de l\'usuari que respon a la pregunta.';
$string ['privacy:metadata:block_tog_intel_answers:question'] = 'L\'identificador de la pregunta.';
$string ['privacy:metadata:block_tog_intel_answers:answer'] = 'L\'identificador de la resposta a la pregunta.';
$string ['privacy:export:block_tog_intel_answers'] = 'Prova d\'intel·ligències';

$string ['privacy:metadata:block_tog_personality'] = 'Informació sobre la personalitat d\'un usuari.';
$string ['privacy:metadata:block_tog_personality:userid'] = 'La identificació de l\'usuari que la personalitat fa referència.';
$string ['privacy:metadata:block_tog_personality:type'] = 'El tipus de personalitat.';
$string ['privacy:metadata:block_tog_personality:gender'] = 'El sexe de l\'usuari.';
$string ['privacy:metadata:block_tog_personality:judgment'] = 'El valor de la personalitat del judici de l\'usuari.';
$string ['privacy:metadata:block_tog_personality:attitude'] = 'Actitud personalitat de l\'usuari.';
$string ['privacy:metadata:block_tog_personality:perception'] = 'La percepció del factor de personalitat de l\'usuari.';
$string ['privacy:metadata:block_tog_personality:gender'] = 'El factor de personalitat extrovertida de l\'usuari.';
$string ['privacy:export:block_tog_personality'] = 'Personalitat';

$string ['privacy:metadata:block_tog_intelligences'] = 'Informació sobre les intel·ligències d\'un usuari.';
$string ['privacy:metadata:block_tog_intelligences:userid'] = 'Identificador de l\'usuari que les intel·ligències refereixen.';
$string ['privacy:metadata:block_tog_intelligences:linguistic'] = 'El factor d\'intel·ligència linguistic de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:logicalmathematical'] = 'El factor d\'intel·ligència lògica/matemàtica de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:spatial'] = 'El factor d\'intel·ligència visual/espacial de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:bodilykinesthetic'] = 'El factor d\'intel·ligència corporal/kinestesica de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:musical'] = 'El factor d\'intel·ligència musical/rítmica de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:intrapersonal'] = 'El factor d\'intel·ligència intrapersonal de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:interpersonal'] = 'El factor d\'intel·ligència interpersonal de l\'usuari.';
$string ['privacy:metadata:block_tog_intelligences:environmental'] = 'El factor d\'intel·ligència naturalista/mediambiental de l\'usuari.';
$string ['privacy:export:block_tog_intelligences'] = 'Intel·ligències';

$string ['personality_title'] = 'Personalitat';
$string ['personality_heading'] = 'Personalitat';
$string ['personality_go_to_test'] = 'Modifica la prova de personalitat';
$string ['personality_read_more'] = 'Llegeix més';
$string ['personality_msg'] = 'La vostra personalitat és {$a->type} ( {$a->name} ). {$a->description}';
$string ['personality_ENFJ_description'] = 'Líders carismàtics i inspiradors, capaços de fascinar als seus oients.';
$string ['personality_ENFJ_more'] = 'https://www.16personalities.com/enfj-personality';
$string ['personality_ENFJ_name'] = 'El protagonista';
$string ['personality_ENFP_description'] = 'Amors entusiastes, creatius i sociables, que sempre poden trobar un motiu per somriure.';
$string ['personality_ENFP_more'] = 'https://www.16personalities.com/enfp-personality';
$string ['personality_ENFP_name'] = 'L\'activista';
$string ['personality_ENTJ_description'] = 'Líders audaços, imaginatius i de voluntats fortes, sempre trobant un camí o fent-ne un.';
$string ['personality_ENTJ_more'] = 'https://www.16personalities.com/entj-personality';
$string ['personality_ENTJ_name'] = 'El comandant';
$string ['personality_ENTP_description'] = 'Pensadors intel·ligents i curiosos que no poden resistir un repte intel·lectual.';
$string ['personality_ENTP_more'] = 'https://www.16personalities.com/entp-personality';
$string ['personality_ENTP_name'] = 'El debator';
$string ['personality_ESFJ_description'] = 'Persones extraordinàriament afectuoses, socials i populars, sempre disposades a ajudar.';
$string ['personality_ESFJ_more'] = 'https://www.16personalities.com/esfj-personality';
$string ['personality_ESFJ_name'] = 'El cònsol';
$string ['personality_ESFP_description'] = 'Persones espontànies, energètiques i entusiastes: la vida mai no és avorrit al seu voltant.';
$string ['personality_ESFP_more'] = 'https://www.16personalities.com/esfp-personality';
$string ['personality_ESFP_name'] = 'L\'animador';
$string ['personality_ESTJ_description'] = 'Excel·lents administradors, insuperables a l\'hora de gestionar les coses, o les persones.';
$string ['personality_ESTJ_more'] = 'https://www.16personalities.com/estj-personality';
$string ['personality_ESTJ_name'] = 'L\'executiu';
$string ['personality_ESTP_description'] = 'Persones intel·ligents, energètiques i molt perceptives, que realment gaudeixen de viure a la vora.';
$string ['personality_ESTP_more'] = 'https://www.16personalities.com/estp-personality';
$string ['personality_ESTP_name'] = 'L\'emprenedor';
$string ['personality_INFJ_description'] = 'Tranquil·litzadors i místics, però molt inspiradors i incansables.';
$string ['personality_INFJ_more'] = 'https://www.16personalities.com/infj-personality';
$string ['personality_INFJ_name'] = 'L\'advocat';
$string ['personality_INFP_description'] = 'Persones poètiques, amables i altruistes, sempre disposades a ajudar a una bona causa.';
$string ['personality_INFP_more'] = 'https://www.16personalities.com/infp-personality';
$string ['personality_INFP_name'] = 'El mediador';
$string ['personality_INTJ_description'] = 'Pensadors imaginatius i estratègics, amb un pla per a tot.';
$string ['personality_INTJ_more'] = 'https://www.16personalities.com/intj-personality';
$string ['personality_INTJ_name'] = 'L\'arquitecte';
$string ['personality_INTP_description'] = 'Inversors innovadors amb una set inquietant de coneixement. Pensadors imaginatius i estratègics, amb un pla per a tot.';
$string ['personality_INTP_more'] = 'https://www.16personalities.com/intp-personality';
$string ['personality_INTP_name'] = 'El lògic';
$string ['personality_ISFJ_description'] = 'Protectors molt dedicats i càlids, sempre disposats a defensar els seus éssers estimats.';
$string ['personality_ISFJ_more'] = 'https://www.16personalities.com/isfj-personality';
$string ['personality_ISFJ_name'] = 'El defensor';
$string ['personality_ISFP_description'] = 'Artistes flexibles i encantadors, sempre disposats a explorar i experimentar alguna cosa nova.';
$string ['personality_ISFP_more'] = 'https://www.16personalities.com/isfp-personality';
$string ['personality_ISFP_name'] = 'L\'aventurer';
$string ['personality_ISTJ_description'] = 'Individus pràctics i de mentalitat, la fiabilitat dels quals no es pot dubtar.';
$string ['personality_ISTJ_more'] = 'https://www.16personalities.com/istj-personality';
$string ['personality_ISTJ_name'] = 'El logístic';
$string ['personality_ISTP_description'] = 'Experts audaces i pràctics, mestres de tot tipus d\'eines.';
$string ['personality_ISTP_more'] = 'https://www.16personalities.com/istp-personality';
$string ['personality_ISTP_name'] = 'El virtuós';
$string ['personality_error_not_answered_all_questions'] = 'Has de respondre totes les preguntes del qüestionari per poder saber la teva personalitat';
$string ['personality_go_to_course'] = 'Tornar al curs';
$string ['personality_go_to_intelligences_test'] = 'Omplir prova d\'intel·ligències';

$string ['intelligences_title'] = 'Intel·ligències';
$string ['intelligences_heading'] = 'Intel·ligències';
$string ['intelligences_msg'] = 'Les vostres intel·ligències són';
$string ['intelligences_value_0'] = 'Coneixement fonamental';
$string ['intelligences_value_1'] = 'Principiant';
$string ['intelligences_value_2'] = 'Intermig';
$string ['intelligences_value_3'] = 'Avançat';
$string ['intelligences_value_4'] = 'Expert';
$string ['intelligences_interpersonal'] = 'Intel·ligència interpersonal';
$string ['intelligences_interpersonal_help'] = 'La intel·ligència interpersonal mesura la percepció de les persones de les seves capacitats en relació amb les relacions socials.';
$string ['intelligences_intrapersonal'] = 'Intel·ligència intrapersonal';
$string ['intelligences_intrapersonal_help'] = 'La intel·ligència intrapersonal constava de dos components. El component “Autoreflexió” mesura les opinions de les persones sobre la seva capacitat de reflexionar sobre temes importants de la vida, i temes psicològics i filosòfics profunds.';
$string ['intelligences_bodilykinesthetic'] = 'Intel·ligència corporal cinestèsica';
$string ['intelligences_bodilykinesthetic_help'] = 'La intel·ligència corporal cinestèsica mesura les opinions de les persones sobre les seves habilitats relacionades amb el treball amb les mans i la coordinació del cos.';
$string ['intelligences_logicalmathematical'] = 'Intel·ligència lògica i matemàtica';
$string ['intelligences_logicalmathematical_help'] = 'La intel·ligència lògico-matemàtica s’utilitza per mesurar les habilitats d’una persona sobre la capacitat matemàtica i el pensament lògic.';
$string ['intelligences_musical'] = 'Intel·ligència musical';
$string ['intelligences_musical_help'] = 'La intel·ligència musical s’utilitza per mesurar la capacitat d’una persona per escoltar o produir música.';
$string ['intelligences_environmental'] = 'Intel·ligència naturalista-mediambiental';
$string ['intelligences_environmental_help'] = 'La intel·ligència ambiental té tres categories següents: 1) Amor per la natura; 2) Conservació de la natura; 3) Hàbits de consum ecològic';
$string ['intelligences_linguistic'] = 'Intel·ligència lingüística';
$string ['intelligences_linguistic_help'] = 'La intel·ligència lingüística s’utilitza per mesurar les habilitats d’una persona en expressions verbals i escrites.';
$string ['intelligences_spatial'] = 'Intel·ligència visual-espacial';
$string ['intelligences_spatial_help'] = 'La intel·ligència espacial mesura les competències de les persones per visualitzar i treballar amb objectes multidimensionals.';
$string ['intelligences_go_to_test'] = 'Modificar la prova d\'intel·ligències';
$string ['intelligences_error_not_answered_all_questions'] = 'Has de respondre totes les preguntes del qüestionari per poder saber les teves intelligencies';
$string ['intelligences_go_to_course'] = 'Tornar al curs';
$string ['intelligences_go_to_personality_test'] = 'Omplir prova de personalitat';

$string ['composite_title'] = 'Grups compostos';
$string ['composite_heading'] = 'Grups compostos per tasca';
$string ['composite_alert_no_capability'] = 'No teniu la capacitat per a grups compostos. Demaneu a l\'administrador els privilegis necessaris per fer-ho.';
$string ['composite_grouping_name'] = 'Nom del conjunt de grups';
$string ['composite_grouping_name_placeholder'] = 'Escriu el nom d\'agrupació.';
$string ['composite_grouping_name_help'] = 'El nom associat al grup que es compondrà.';
$string ['composite_groups_pattern'] = 'Patró de grup';
$string ['composite_groups_pattern_default'] = 'Grup {}';
$string ['composite_groups_pattern_help'] = 'El patró utilitzat per generar el nom dels grups. El símbol {} serà reemplaçat per l\'índex del grup generat.';
$string ['composite_members_per_group'] = 'Membres per grup';
$string ['composite_members_per_group_help'] = 'El nombre d\'estudiants que ha de ser a cada grup generat.';
$string ['composite_error_not_enough_users'] = 'No hi ha prou usuaris que han omplert les proves de personalitat i d\'intel·ligència.';
$string ['composite_column_name'] = 'Nom d\'usuari';
$string ['composite_column_personality'] = 'Ompliu la prova de personalitat';
$string ['composite_column_personality_not_filled'] = 'L\'usuari no ha completat la prova de personalitat';
$string ['composite_column_personality_filled'] = 'L\'usuari ha completat la prova de personalitat';
$string ['composite_column_intelligences'] = 'Ompliu la prova d\'intel·ligències';
$string ['composite_column_intelligences_not_filled'] = 'L\'usuari no ha omplert la prova d\'intel·ligències';
$string ['composite_column_intelligences_filled'] = 'L\'usuari ha completat la prova d\'intel·ligències';
$string ['composite_column_send'] = 'Enviar missatge';
$string ['composite_column_send_alt'] = 'Envieu un missatge a l\'usuari que no hagi omplert la prova de personalitat o intel·ligència';
$string ['composite_unfilled_msg'] = 'Hi ha usuaris de {$a} que no han completat la prova de personalitat o intel·ligències. Sense aquesta informació, no és possible saber quin grup voleu, de manera que no s\'afegiran a cap grup. A la taula següent podeu saber qui són.';
$string ['composite_select_role_for_users'] = 'Selecciona membres amb funcions';
$string ['composite_select_role_for_users_help'] = 'Seleccioneu la funció dels membres que s\'han d\'utilitzar per formar els grups';
$string ['composite_send_selected'] = 'Enviar missatge a les seleccionades';
$string ['composite_send_all'] = 'Envia un missatge a tothom';
$string ['composite_members_per_group_how_many_pattern'] = 'Podeu formar {{groups}} grups  amb {{size}} membres en cadascun d\'ells';
$string ['composite_members_per_group_how_many_pattern_2'] = 'Podeu formar {{groups1}} grups amb {{size1}} membres en cadascun i {{groups2}} grups amb {{size2}} membres en cadascun';
$string ['composite_requirements'] = 'Requisits';
$string ['composite_requirements_help'] = 'Requisits necessaris per fer la tasca en qüestió';
$string ['composite_requirements_add'] = 'Afegeix';
$string ['composite_requirements'] = 'Factor';
$string ['composite_requirements_factor_help'] = 'Les intel·ligències requerides pels grups de membres per dur a terme la tasca en qüestió';
$string ['composite_requirements_factor_0'] = 'Lingüística';
$string ['composite_requirements_factor_1'] = 'Lògica-Matemàtica';
$string ['composite_requirements_factor_2'] = 'Visual-espacial';
$string ['composite_requirements_factor_3'] = 'Bodily-kinesthetic';
$string ['composite_requirements_factor_4'] = 'Musical';
$string ['composite_requirements_factor_5'] = 'Intrapersonal';
$string ['composite_requirements_factor_6'] = 'Interpersonal';
$string ['composite_requirements_factor_7'] = 'Naturalista-ambiental';
$string ['composite_requirements_importance'] = 'Importància';
$string ['composite_requirements_importance_help'] = 'La importància d\'aquesta intel·ligència per dur a terme la tasca en qüestió';
$string ['composite_requirements_importance_0'] = 'No és gens important';
$string ['composite_requirements_importance_1'] = 'Molt important';
$string ['composite_requirements_importance_2'] = 'Important';
$string ['composite_requirements_importance_3'] = 'Bastant important';
$string ['composite_requirements_importance_4'] = 'Molt important';
$string ['composite_requirements_level'] = 'Nivell';
$string ['composite_requirements_level_help'] = 'El nivell d\'intel·ligència requerit';
$string ['composite_requirements_level_0'] = 'Coneixement fonamental';
$string ['composite_requirements_level_1'] = 'Principiant';
$string ['composite_requirements_level_2'] = 'Intermig';
$string ['composite_requirements_level_3'] = 'Avançat';
$string ['composite_requirements_level_4'] = 'Expert';
$string ['composite_requirements_none'] = 'De moment, la tasca no té requisits d\'intel·ligència. Els membres s\'agrupen segons el gènere i la personalitat.';
$string ['composite_requirements_pattern'] = 'Per a la intel·ligència {$a->factor} és {$a->importance} un nivell mínim de {$a->level} nivell';
$string ['composite_performance'] = 'Rendiment';
$string ['composite_performance_help'] = 'Definiu si voleu obtenir més rendiment o grups de baix rendiment';
$string ['composite_performance_over'] = 'Més rendiment';
$string ['composite_performance_under'] = 'Baixa comportament';
$string ['composite_submit'] = 'Grups compostos';
$string ['composite_progress'] = 'Càlcul';
$string ['composite_groups_error_title'] = 'Error';
$string ['composite_groups_error_text'] = 'No es pot calcular els grups.';
$string ['composite_groups_error_continue'] = 'D\'acord';

$string ['externallib:group_description_reponsable_of'] = 'és reponsable de';
$string ['externallib:group_description_no_responsibility'] = 'no té reponmsabilitats al grup';
$string ['externallib:group_description_last_intelligence_and'] = 'i';
$string ['externallib:group_description_intelligence_interpersonal'] = 'Intel·ligència interpersonal';
$string ['externallib:group_description_intelligence_intrapersonal'] = 'Intel·ligència intrapersonal';
$string ['externallib:group_description_intelligence_bodilykinesthetic'] = 'Intel·ligència corporal cinestèsica';
$string ['externallib:group_description_intelligence_logicalmathematical'] = 'Intel·ligència lògica i matemàtica';
$string ['externallib:group_description_intelligence_musical'] = 'Intel·ligència musical';
$string ['externallib:group_description_intelligence_environmental'] = 'Intel·ligència naturalista-mediambiental';
$string ['externallib:group_description_intelligence_linguistic'] = 'Intel·ligència lingüística';
$string ['externallib:group_description_intelligence_spatial'] = 'Intel·ligència visual-espacial';

$string ['auto_fill_in_title'] = 'Omplir automàticament els qüestionaris';
$string ['auto_fill_in_heading'] = 'Omplir automàticament els qüestionaris dels usuaris';
$string ['auto_fill_in_column_name'] = 'Nom d\'usuari';
$string ['auto_fill_in_column_personality'] = 'Omplir el qüestionari de personalitat';
$string ['auto_fill_in_submit_personality'] = 'Omplir automàticament';
$string ['auto_fill_in_column_personality_filled'] = 'L\'usuari ja ha emplenat el qüestionari de personalitat';
$string ['auto_fill_in_column_intelligences'] = 'Omplir el qüestionari de intel·ligències';
$string ['auto_fill_in_submit_intelligences'] = 'Omplir automàticament';
$string ['auto_fill_in_column_intelligences_filled'] = 'L\'usuari ja ha emplenat el qüestionari de intel·ligències';

$string ['feedback_test_title'] = 'Proporcioneu informació sobre el rendiment d\'un grup';
$string ['feedback_test_heading'] = 'Proporcioneu informació sobre el rendiment d\'un grup';
$string ['feedback_question_0'] = 'El grup s\'ha organitzat i ha col·laborat, tothom s\'ha implicat en les tasques a fer';
$string ['feedback_question_1'] = 'Tot el grup ha parlat per tal de prendre acords i planificar les tasques';
$string ['feedback_question_2'] = 'El grup ha treballat de manera autònoma: els problemes han estat solucionats dins del grup, i les solucions s\'han trobat entre tots';
$string ['feedback_question_3'] = 'El grup ha fet una coevaluacio de manera crítica i responsable';
$string ['feedback_question_answer_0'] = 'Poc';
$string ['feedback_question_answer_1'] = 'Ni molt ni poc';
$string ['feedback_question_answer_2'] = 'Molt';
$string ['feedback_test_submit'] = 'Informeu dels comentaris';
$string ['feedback_test_progress'] = 'Informant';
$string ['feedback_test_groups_error_title'] = 'Error';
$string ['feedback_test_groups_error_text'] = 'No es pot informar del rendiment del grup.';
$string ['feedback_test_groups_error_continue'] = 'D\'acord';
$string ['feedback_test_alert_no_capability'] = 'No tens els permisos per a obtenir el rendiment d\'un grup. Demaneu a l\'administrador els privilegis necessaris per fer-ho.';
$string ['feedback_test_alert_empty'] = 'No hi ha grups per poder obtenir el rendiment dels seus integrants.';
$string ['feedback_test_grouping_selector'] = 'Sel·leciona un conjunt de grups';
$string ['feedback_test_grouping_selector_help'] = 'Has de sel·lecionar el conjunt on està el grup del que vols obtenir el rendiment dels seus integrants.';
$string ['feedback_test_group_selector'] = 'Sel·leciona un grup';
$string ['feedback_test_group_selector_help'] = 'Has de sel·lecionar de quin grup vols obtenir el rendiments dels seus integrants.';
$string ['feedback_test_group'] = 'Grup';
$string ['feedback_test_group_help'] = 'Has de sel·lecionar de quin grup vols obtenir el rendiment dels seus integrants.';
$string ['feedback_test_alert_submit_success'] = 'S\'ha emmagatzemat la teva opinió.';
