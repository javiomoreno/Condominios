CREATE TABLE tipoUsuarios (
  id_tipoUsuario INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(100)  NULL  ,
  descripcion VARCHAR(250)  NULL    ,
PRIMARY KEY(id_tipoUsuario));



CREATE TABLE items (
  id_item INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(100)  NULL  ,
  descripcion VARCHAR(250)  NULL  ,
  precio DOUBLE  NULL  ,
  fecha_registro DATE  NULL    ,
PRIMARY KEY(id_item));



CREATE TABLE servicios (
  id_servicio INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(100)  NULL  ,
  descripcion VARCHAR(250)  NULL  ,
  precio DOUBLE  NULL  ,
  fecha_registro DATE  NULL    ,
PRIMARY KEY(id_servicio));



CREATE TABLE condicionUsuarios (
  id_condicionUsuario INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(100)  NULL  ,
  descricion VARCHAR(250)  NULL    ,
PRIMARY KEY(id_condicionUsuario));



CREATE TABLE usuarios (
  id_usuario INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  condicionUsuarios_id_condicionUsuario INTEGER UNSIGNED  NOT NULL  ,
  tipoUsuarios_id_tipoUsuario INTEGER UNSIGNED  NOT NULL  ,
  nombre VARCHAR(100)  NULL  ,
  apellido VARCHAR(100)  NULL  ,
  correo VARCHAR(100)  NULL  ,
  telefono VARCHAR(100)  NULL  ,
  usuario VARCHAR(100)  NULL  ,
  clave VARCHAR(100)  NULL    ,
PRIMARY KEY(id_usuario)  ,
INDEX usuarios_FKIndex1(tipoUsuarios_id_tipoUsuario)  ,
INDEX usuarios_FKIndex2(condicionUsuarios_id_condicionUsuario),
  FOREIGN KEY(tipoUsuarios_id_tipoUsuario)
    REFERENCES tipoUsuarios(id_tipoUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(condicionUsuarios_id_condicionUsuario)
    REFERENCES condicionUsuarios(id_condicionUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE apartamentos (
  id_apartamento INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  usuarios_id_usuario INTEGER UNSIGNED  NOT NULL  ,
  ubicacion VARCHAR(250)  NULL  ,
  observaciones VARCHAR(250)  NULL    ,
PRIMARY KEY(id_apartamento)  ,
INDEX apartamentos_FKIndex2(usuarios_id_usuario),
  FOREIGN KEY(usuarios_id_usuario)
    REFERENCES usuarios(id_usuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE factura_gastos (
  id_factura_gastos INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  items_id_item INTEGER UNSIGNED  NOT NULL  ,
  apartamentos_id_apartamento INTEGER UNSIGNED  NOT NULL  ,
  fecha_registro DATE  NULL  ,
  iva DOUBLE  NULL  ,
  total DOUBLE  NULL  ,
  descripcion VARCHAR(250)  NULL    ,
PRIMARY KEY(id_factura_gastos)  ,
INDEX factura_gastos_FKIndex1(apartamentos_id_apartamento)  ,
INDEX factura_gastos_FKIndex2(items_id_item),
  FOREIGN KEY(apartamentos_id_apartamento)
    REFERENCES apartamentos(id_apartamento)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(items_id_item)
    REFERENCES items(id_item)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE factura_servicios (
  id_factura_servicios INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  servicios_id_servicio INTEGER UNSIGNED  NOT NULL  ,
  apartamentos_id_apartamento INTEGER UNSIGNED  NOT NULL  ,
  fecha_factura DATE  NULL  ,
  fecha_vencimiento DATE  NULL  ,
  iva DOUBLE  NULL  ,
  total DOUBLE  NULL  ,
  estado INTEGER UNSIGNED  NULL  ,
  observciones VARCHAR(250)  NULL    ,
PRIMARY KEY(id_factura_servicios)  ,
INDEX factura_servicios_FKIndex1(apartamentos_id_apartamento)  ,
INDEX factura_servicios_FKIndex2(servicios_id_servicio),
  FOREIGN KEY(apartamentos_id_apartamento)
    REFERENCES apartamentos(id_apartamento)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(servicios_id_servicio)
    REFERENCES servicios(id_servicio)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);




