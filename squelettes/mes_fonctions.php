<?php
function autoriser_article_flash1_modifierextra_dist($faire, $type, $id, $qui, $opt){
    $id_rubrique = $opt['contexte']['id_rubrique'];
    if (!$id_rubrique) {
        $id_rubrique = sql_getfetsel("id_rubrique", "spip_articles", "id_article=".intval($id));
    }
    if ($id_rubrique == 15) {
        return true;
    }
    return false;
}
function autoriser_article_flash1_voirextra_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('modifierextra', $type, $id, $qui, $opt);
}

function autoriser_article_flash_2_modifierextra_dist($faire, $type, $id, $qui, $opt){
    $id_rubrique = $opt['contexte']['id_rubrique'];
    if (!$id_rubrique) {
        $id_rubrique = sql_getfetsel("id_rubrique", "spip_articles", "id_article=".intval($id));
    }
    if ($id_rubrique == 15) {
        return true;
    }
    return false;
}
function autoriser_article_flash_2_voirextra_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('modifierextra', $type, $id, $qui, $opt);
}
function autoriser_article_flash_3_modifierextra_dist($faire, $type, $id, $qui, $opt){
    $id_rubrique = $opt['contexte']['id_rubrique'];
    if (!$id_rubrique) {
        $id_rubrique = sql_getfetsel("id_rubrique", "spip_articles", "id_article=".intval($id));
    }
    if ($id_rubrique == 15) {
        return true;
    }
    return false;
}
function autoriser_article_flash_3_voirextra_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('modifierextra', $type, $id, $qui, $opt);
}
function autoriser_article_flash_4_modifierextra_dist($faire, $type, $id, $qui, $opt){
    $id_rubrique = $opt['contexte']['id_rubrique'];
    if (!$id_rubrique) {
        $id_rubrique = sql_getfetsel("id_rubrique", "spip_articles", "id_article=".intval($id));
    }
    if ($id_rubrique == 15) {
        return true;
    }
    return false;
}
function autoriser_article_flash_4_voirextra_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('modifierextra', $type, $id, $qui, $opt);
}


?>