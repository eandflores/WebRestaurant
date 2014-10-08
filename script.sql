CREATE TABLE SUCURSAL(
	suc_id serial,
	suc_nombre varchar(30),
	suc_telefono varchar(20),
	suc_direccion varchar(50),
	CONSTRAINT pk_sucursal PRIMARY KEY (suc_id)
);

CREATE TABLE INGREDIENTE(
	ing_id serial,
	ing_nombre varchar(30),
	ing_precio float,
	ing_proveedor varchar(30),
	ing_stock float,
	ing_medida varchar(10),
	suc_id integer,
	CONSTRAINT pk_ingredientes PRIMARY KEY (ing_id),
	FOREIGN KEY (suc_id) REFERENCES SUCURSAL (suc_id)
);

CREATE TABLE PRODUCTO(
	pro_id serial,
	pro_precio float,
	pro_tiempo float,
	pro_nombre varchar(30),
	pro_estado boolean,
	suc_id integer,
	CONSTRAINT pk_productos PRIMARY KEY (pro_id),
	FOREIGN KEY (suc_id) REFERENCES SUCURSAL (suc_id)
);

CREATE TABLE CONSUME(
	pro_id serial,
	ing_id serial,
	con_cantidad float,
	CONSTRAINT pk_consume PRIMARY KEY (pro_id,ing_id),
	FOREIGN KEY (pro_id) REFERENCES PRODUCTOS (pro_id),
	FOREIGN KEY (ing_id) REFERENCES INGREDIENTE (ing_id)
);

CREATE TABLE MENU(
	men_id serial,
	men_nombre varchar(30),
	men_total float,
	men_cantidad float,--cantidad de producto
	men_estado boolean,
	suc_id integer,
	CONSTRAINT pk_menu PRIMARY KEY (men_id),
	FOREIGN KEY (suc_id) REFERENCES SUCURSAL (suc_id)
);

CREATE TABLE POSEE(
	men_id serial,
	pro_id serial,
	pos_cantidad float,
	CONSTRAINT pk_posee PRIMARY KEY (men_id,pro_id),
	FOREIGN KEY (men_id) REFERENCES MENU (men_id),
	FOREIGN KEY (pro_id) REFERENCES PRODUCTOS (pro_id)
);

CREATE TABLE ROL(
	rol_id serial,
	rol_nombre varchar(15),
	rol_sueldo_base integer,
	rol_sueldo_hora integer,
	CONSTRAINT pk_rol PRIMARY KEY (rol_id)
);

CREATE TABLE TRABAJADOR(
	tra_rut varchar(12),
	tra_nombre varchar(30),
	tra_apellido varchar(30),
	tra_telefono varchar(20),
	tra_correo varchar(30),
	tra_direccion varchar(50),
	tra_password varchar(50),
	tra_estado boolean,
	rol_id serial,
	suc_id serial,
	CONSTRAINT pk_trabajador PRIMARY KEY (tra_rut),
	FOREIGN KEY (rol_id) REFERENCES ROL (rol_id),
	FOREIGN KEY (suc_id) REFERENCES SUCURSAL (suc_id)
);

CREATE TABLE SUELDO(
	sue_id serial,
	sue_monto float,
	sue_fecha_pago date,
	sue_horas_trab float,
	tra_rut varchar(12),
	CONSTRAINT pk_sueldo PRIMARY KEY (sue_id),
	FOREIGN KEY (tra_rut) REFERENCES TRABAJADOR (tra_rut)
);

CREATE TABLE CAJA(
	caj_id serial,
	caj_nombre varchar(30),
	suc_id serial,
	CONSTRAINT pk_caja PRIMARY KEY (caj_id),
	FOREIGN KEY (suc_id) REFERENCES SUCURSAL (suc_id)
);

CREATE TABLE CLIENTE(
	cli_rut varchar(12),
	cli_nombre varchar(30),
	cli_apellido varchar(30),
	cli_correo varchar(30),
	cli_telefono varchar(20),
	cli_password varchar(50),
	cli_direccion varchar(50),
	CONSTRAINT pk_cliente PRIMARY KEY (cli_rut)
);

CREATE TABLE ABRE(
caj_id serial,
tra_rut varchar(12),
CONSTRAINT pk_abre PRIMARY KEY (caj_id,tra_rut),
FOREIGN KEY (caj_id) REFERENCES CAJA (caj_id),
FOREIGN KEY (tra_rut) REFERENCES TRABAJADOR (tra_rut)
);

CREATE TABLE MESA(
	mes_id serial,
	suc_id serial,
	mes_numero integer,
	mes_estado boolean,
	CONSTRAINT pk_mesa PRIMARY KEY (mes_id)
	FOREIGN KEY (suc_id) REFERENCES sucursal (suc_id)
);

CREATE TABLE RESERVA(
	res_id serial,
	cli_rut varchar(12),
	mes_id integer,
	res_fecha date,
	res_estado boolean,
	CONSTRAINT pk_reserva PRIMARY KEY (res_id),
	FOREIGN KEY (cli_rut) REFERENCES CLIENTE (cli_rut),
	FOREIGN KEY (mes_id) REFERENCES MESA (mes_id)
);

CREATE TABLE VENTA(
	ven_id serial,
	ven_fecha date,
	ven_total integer,
	ven_mediopago varchar(10),
	ven_estado varchar(10),
	caj_id integer,
	cli_rut varchar(12),
	mes_id integer,
	CONSTRAINT pk_venta PRIMARY KEY (ven_id),
	FOREIGN KEY (caj_id) REFERENCES CAJA (caj_id),
	FOREIGN KEY (cli_rut) REFERENCES CLIENTE (cli_rut),
	FOREIGN KEY (mes_id) REFERENCES MESA (mes_id)
);

CREATE TABLE PEDIDO(
	ped_id serial,
	ped_estado varchar(10),
	ped_total integer,
	ped_hora timestamp,
	ven_id integer,
	mes_id integer,
	CONSTRAINT pk_pedido PRIMARY KEY (ped_id),
	FOREIGN KEY (ven_id) REFERENCES VENTA (ven_id),
	FOREIGN KEY (mes_id) REFERENCES MESA (mes_id)
);

CREATE TABLE TIENE(
	ped_id serial,
	men_id serial,
	CONSTRAINT pk_tiene PRIMARY KEY (ped_id,men_id),
	FOREIGN KEY (ped_id) REFERENCES PEDIDO (ped_id),
	FOREIGN KEY (men_id) REFERENCES MENU (men_id)
);

CREATE TABLE CUENTA(
	ped_id serial,
	pro_id serial,
	CONSTRAINT pk_cuenta PRIMARY KEY (ped_id,pro_id),
	FOREIGN KEY (ped_id) REFERENCES PEDIDO (ped_id),
	FOREIGN KEY (pro_id) REFERENCES PRODUCTOS (pro_id)
);

-- Vendedor no puede agregar cliente
-- Productos no dejan seleccionar unidad de medidad
-- Remuneracion no deja ingresar horas en decimal
-- No se puede editar el nombre del rol
-- Venta asociada al cliente
-- Agregar venta cierra mesa y no agrega pedido
-- Para pedidos a domicilio
	-- Caja PENDIENTE debe incluirse
	-- Mesa -1 debe incluirse
-- Mesa -1 aparece para reservar
-- mesa -1 aparece para agregar venta a cola
-- mesa -1 aparece en cola de ventas con muero -1
-- mesa -1 aparece para cerrar venta
-- rut cliente se piede para agregar venta a cola
-- mesa -1 al finalizar pedido 
-- Se pueden cerrar ventas sin cerrar pedidos
-- Mesas que se reservan online ¿ Ocupan mesa ?
-- eliminar producto no funciona
-- Gastos no funcionan
-- productos no se pueden deshabilitar
-- no dejar comprar producto ni menus deshabilitados
-- no se ven ingredientes en ver detalle, ni en editar
-- sacar id mesa y tildar numero mesa en gestion mesas
-- sacar mesa -1 gestion mesas
-- ordenar mesas por numero
-- guardar mesa deja guardar numero que ya existe en sucursal
-- permitir habilitar o deshabilitar en gestion productos
-- llamadas a acciones de productos malas
-- Ventas layout redirigia a furai admin
-- Rut no es clave foranea
-- Agregar opcion venta sin cliente
-- Quitar opcion generar ticket, se debe agregar al cerrar venta
-- Mesa en agregar venta
-- Mostrar cant en Inventario al momento de hacer ventas y pedidos
-- Pedidos y ventas no funcionan en base a sucursal
-- Se cambia el estado del pedido antes de descontar ingredientes
-- AL ingresar venta saca al index
-- Cerrar venta no deja disponible mesa

---------------------------------------------------
-- se quito el logo de los 3 layouts, logo pequeño, tutulo y
	-- nombre local de index
	-- Ventas layout redirigia a furai admin
-- agrego clase invisible
-- desaparecer sucursal informe ventas
-- desaparecer form sucursal gestion personal
-- desaparecer form sucursal gestion inventario
-- quitar los agregar y separadores gestion inventario
-- quitar gastos de menu
-- quitar todos los gestion de menu administracion admin,
	-- excepto gestion mesas
-- agregar agregar mesa a menu admin y cambiar administracion 
	-- por mesas
-- quitar form sucursal gestion mesas
-- sacar id mesa y tildar numero mesa en gestion mesas
-- sacar mesa -1 gestion mesas
-- ordenar mesas por numero
-- guardar mesa dejaba guardar numero que ya existe en sucursal
-- Gestion menu dice estado en vez de acciones
-- productos no se pueden deshabilitar
-- mostrar estado producto en gestion productos
-- no dejar comprar producto ni menus deshabilitados
-- no se ve estado en ver detalle de producto
-- permitir habilitar o deshabilitar en gestion productos
-- llamadas a acciones de productos malas
-- invisible saldo inicial caja
-- invisible pedidos a domicilio
-- opcion venta sin cliente
-- Venta mesa en vez de venta en cerrar venta
-- Quitar opcion generar ticket
-- Mesa en agregar venta
-- en aceptada cambiar estado de pedido a ENTREGADO en vez de true
-- sacar cancelar venta (al cerrar venta verifica que no hayan ventas
	-- pendientes que esten canceladas o realizadas y se cobra solo
	-- las entregadas


