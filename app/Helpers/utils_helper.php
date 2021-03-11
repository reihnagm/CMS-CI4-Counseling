<?php

function shortCityName($city)
{
  switch (strtolower($city)) {
    case "jakarta":
      $city = "JKT";
      break;
    case "bandung":
      $city = "BDG";
      break;
    case "medan":
      $city = "MDN";
      break;
    case "merauke":
      $city = "MRK";
      break;
    case "makassar":
      $city = "MKS";
      break;
    case "merauke":
      $city = "MRK";
      break;
    case "manado":
      $city = "MND";
      break;
    case "mojosari":
      $city = "MJS";
      break;
    case "morotaiselatan":
      $city = "MTS";
      break;
    case "cakung":
      $city = "CGK";
      break;
    case "cempaka":
      $city = "CPK";
      break;
    case "ciawi":
      $city = "CIW";
      break;
    case "cibinong":
      $city = "CBL";
      break;
    case "cibubur":
      $city = "CBB";
      break;
    case "cisarua":
      $city = "CSA";
      break;
    case "ciwidey":
      $city = "CWD";
      break;
    default:
  }
  return $city;
}

function fdate($date)
{
  setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
  return strftime('%d %B %Y', strtotime($date));
}

function checkIfContains($needle, $haystack)
{
  return preg_match('#\b' . preg_quote($needle, '#') . '\b#i', $haystack) !== 0;
}
