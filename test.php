<?php 

$data = password_hash('asdasd',PASSWORD_DEFAULT);

echo password_verify('$2y$10$gcyea6ojs.giz4zRA3V5Uewlucm2aHOp1ULakUd8GhBXAb0xF6eC6',PASSWORD_DEFAULT);


Table jabatan {
    jabatanCode bigint [pk, increment, not null]
    jabatan varchar(100) [not null]
    createAt datetime [not null, default: `now()`]
    updateAt datetime [null]
    deleteAt datetime [null]
  }
  
  Table pangkat {
    pangkatCode bigint [pk, increment, not null]
    pangkat varchar(100) [not null]
    createAt datetime [not null, default: `now()`]
    updateAt datetime [null]
    deleteAt datetime [null]
  }
  
  Table golongan {
    golonganCode bigint [pk, increment, not null]
    golongan varchar(100) [not null]
    createAt datetime [not null, default: `now()`]
    updateAt datetime [null]
    deleteAt datetime [null]
  }
  
  Table prosecutor {
    prosecutorCode bigint [pk, increment, not null]
    name varchar(100) [not null]
    nip varchar(30) [not null]
    photo varchar(255) [not null]
    jabatanCode bigint [ref: > jabatan.jabatanCode]
    pangkatCode bigint [ref: > pangkat.pangkatCode]
    golonganCode bigint [ref: > golongan.golonganCode]
    userCode bigint [ref: - user.userCode]
    createAt datetime [not null, default: `now()`]
    updateAt datetime [null]
    deleteAt datetime [null]
  }
  
  Table complaint {
    complaintCode bigint [pk, increment, not null]
    no varchar (100) [not null]
    letterDate datetime [not null]
    receiptDate datetime [not null]
    letterOrigin varchar (100) [not null]
    regarding longtext [not null]
    
  }
  
  Table task{
    taskCode bigint [pk, increment, not null]
  }