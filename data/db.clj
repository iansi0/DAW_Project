
Table "alumne" {
  "id_user" binary(32) [pk, not null]
  "nom" varchar(20) [not null]
  "cognoms" varchar(80) [not null]
  "codi_centre" binary(32) [not null]
  "id_curs" binary(32) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "centre" {
  "codi" varchar(10) [not null]
  "id_user" binary(32) [pk, not null]
  "nom" varchar(100) [not null]
  "actiu" tinyint(1) [not null]
  "taller" tinyint(1) [not null]
  "telefon" varchar(9) [not null]
  "adreca_fisica" varchar(100) [not null]
  "nom_persona_contacte" varchar(50) [not null]
  "correu_persona_contacte" varchar(50) [not null]
  "id_sstt" int(10) [not null]
  "id_poblacio" binary(32) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]

  Indexes {
    codi [name: "codi"]
  }
}

Table "comarca" {
  "codi" varchar(5) [pk, not null]
  "nom" varchar(50) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "curs" {
  "id" binary(32) [pk, not null]
  "curs" int(4) [not null]
  "any" int(1) [not null]
  "titol" varchar(20) [not null]
  "codi_centre" varchar(10) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "estat" {
  "id" int(3) [pk, not null]
  "nom" varchar(20) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "intervencio" {
  "id" binary(32) [pk, not null]
  "descripcio" varchar(100) [not null]
  "id_ticket" binary(32) [not null]
  "id_tipus" int(3) [not null]
  "id_user" binary(32) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "inventari" {
  "id" binary(32) [pk, not null]
  "nom" varchar(200) [not null]
  "data_compra" date [not null, default: "2024-05-27"]
  "preu" float [not null]
  "codi_centre" varchar(10) [not null]
  "id_tipus_inventari" int(11) [not null]
  "id_intervencio" binary(32) [default: NULL]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "migrations" {
  "id" bigint(20) [pk, not null, increment]
  "version" varchar(255) [not null]
  "class" varchar(255) [not null]
  "group" varchar(255) [not null]
  "namespace" varchar(255) [not null]
  "time" int(11) [not null]
  "batch" int(11) [not null]
}

Table "poblacio" {
  "id" varchar(8) [pk, not null]
  "nom" varchar(100) [not null]
  "id_comarca" binary(2) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "professor" {
  "id_user" binary(32) [pk, not null]
  "nom" varchar(20) [not null]
  "cognoms" varchar(80) [not null]
  "codi_centre" varchar(10) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "roles" {
  "id" binary(32) [pk, not null]
  "role" varchar(100) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "sstt" {
  "id_user" binary(32) [pk, not null]
  "codi" varchar(10) [not null]
  "nom" varchar(40) [not null]
  "adreca_fisica" varchar(100) [not null]
  "cp" varchar(5) [not null]
  "poblacio" varchar(100) [not null]
  "telefon" varchar(9) [default: NULL]
  "altres" varchar(250) [default: NULL]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]

  Indexes {
    codi [name: "codi"]
  }
}

Table "tipus_dispositiu" {
  "id" int(3) [pk, not null]
  "nom" varchar(20) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "tipus_intervencio" {
  "id" binary(32) [pk, not null]
  "nom" varchar(20) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "tipus_inventari" {
  "id" int(11) [pk, not null]
  "nom" varchar(30) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "tiquet" {
  "id" binary(32) [pk, not null]
  "codi_dispositiu" varchar(100) [not null]
  "descripcio_avaria" varchar(200) [not null]
  "nom_persona_contacte_centre" varchar(100) [not null]
  "correu_persona_contacte_centre" varchar(100) [not null]
  "id_tipus_dispositiu" int(2) [not null]
  "id_estat" int(3) [not null]
  "codi_centre_emissor" varchar(10) [not null]
  "codi_centre_reparador" varchar(10) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}

Table "users" {
  "id" binary(32) [pk, not null]
  "user" varchar(200) [not null]
  "passwd" varchar(100) [default: NULL]
  "lang" varchar(10) [default: NULL]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]

  Indexes {
    user [name: "user"]
  }
}

Table "users_in_roles" {
  "id" binary(32) [pk, not null]
  "id_user" binary(32) [not null]
  "id_role" binary(32) [not null]
  
  "created_at" datetime [not null]
  "updated_at" datetime [not null]
  "deleted_at" datetime [default: NULL]
}


// FOREIGN KEY SSTT
Ref: users.id - sstt.id_user

// FOREIGN KEY POBLACIO
Ref: comarca.codi > poblacio.id_comarca

// FOREIGN KEY CENTRE
Ref: users.id - centre.id_user
Ref: sstt.codi > centre.id_sstt
Ref: poblacio.id > centre.id_poblacio

// FOREIGN KEY PROFESSOR
Ref: users.id - professor.id_user
Ref: centre.codi > professor.codi_centre

// FOREIGN KEYS ALUMNE
Ref: users.id - alumne.id_user
Ref: centre.codi > alumne.codi_centre
Ref: curs.id > alumne.id_curs

// FOREIGN KEY CURS
Ref: centre.codi > curs.codi_centre

// FOREIGN KEY INTERVENCIO
Ref: tiquet.id > intervencio.id_ticket
Ref: tipus_intervencio.id - intervencio.id_tipus
Ref: users.id - intervencio.id_user

// FOREIGN KEY TICKET
Ref: tipus_dispositiu.id > tiquet.id_tipus_dispositiu 
Ref: estat.id > tiquet.id_estat 
Ref: centre.codi > tiquet.codi_centre_emissor 
Ref: centre.codi > tiquet.codi_centre_reparador 

// FOREIGN KEY INVENTARI
Ref: centre.codi > inventari.codi_centre
Ref: tipus_inventari.id > inventari.id_tipus_inventari
Ref: intervencio.id > inventari.id_intervencio

// FOREIGN KEY USERSINROLES
Ref: roles.id > users_in_roles.id_role
Ref: users.id > users_in_roles.id_user
