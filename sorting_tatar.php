<?php
/*

Array of Tatar words sorting function
Ayrat V Zakir

*/
mb_internal_encoding('utf-8');

$wrds = file("ii.txt");
$wrds = array_map('trim',$wrds);
/* $alifs = array('А','Ә','Б','В','Г','Д','Е','Ё','Ж','Җ','З','И','Й','К','Л','М','Н','Ң','О','Ө','П','Р','С','Т','У','Ү','Ф','Х','Һ','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я',
                'а','ә','б','в','г','д','е','ё','ж','җ','з','и','й','к','л','м','н','ң','о','ө','п','р','с','т','у','ү','ф','х','һ','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'); */
$alifs = 'АаӘәБбВвГгДдЕеЁёЖжҖҗЗзИиЙйКкЛлМмНнҢңОоӨөПпРрСсТтУуҮүФфХхҺһЦцЧчШшЩщЪъЫыЬьЭэЮюЯя';

echo $alifs.PHP_EOL;

function compareChar($a, $b) {
    global $alifs;
    $characters = $alifs;
    $pos_a = mb_strpos($characters, $a);
    $pos_b = mb_strpos($characters, $b);
    if ($pos_a === false) {
      if ($pos_b === false) {
        return 0;
      } else {
        return 1;
      }
    } elseif ($pos_b === false) {
      return -1;
    } else {
      return $pos_a - $pos_b;
    }
  }


  function compare($a, $b) {
    if ($a == $b) {
      return 0;
    } else {
      for ($i = 0; $i < min(mb_strlen($a), mb_strlen($b)); $i++) {
        $cmp = compareChar(mb_substr($a, $i, 1), mb_substr($b, $i, 1));
        if ($cmp != 0) {
          return $cmp;
        }
      }
      return (mb_strlen($a) > mb_strlen($b)) ? 1 : 0;
    }
  }

usort($wrds, 'compare');
file_put_contents('index.sorted',$wrds);

