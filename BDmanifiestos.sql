drop database manifiestosbd;
create database manifiestosbd;
drop table manifiestos;
use  manifiestosbd;
 

create table manifiestos (
id int (11) auto_increment,
consecutivo int (10),
ruta varchar (200),
fecha date default null,
cliente varchar (100),
placa varchar (50),
cisterna varchar (50),
conductor varchar (150),
cedula varchar (50),
cantidad int (11),
valor int (11),
primary key (id)
);

SET GLOBAL max_allowed_packet=1073741824;

create table cabezote (
placa varchar (11),
marca varchar (20),
estado varchar (11),
observaciones varchar (200),
primary key (placa)
);

insert into cabezote values
('JKU766','SINOTRUCK','OPERATIVA','Ninguna'),
('JKU768','SINOTRUCK','OPERATIVA','Ninguna');

create table cisterna (
r varchar (11),
marca varchar (20),
estado varchar (11),
observaciones varchar (200),
primary key (r)
);

insert into cisterna values
('72009','JHUR','CARGADA','Ninguna'),
('72212','JHUR','CARGADA','Ninguna');

create table conductores (
cedula int (11),
nombre varchar (100),
telefono varchar (11),
estado varchar (50),
observacion varchar (200),
placa varchar (11),
r varchar (11),
primary key (cedula),
foreign key (placa) references cabezote (placa),
foreign key (r) references cisterna (r)
);

insert into conductores values
('1005173','Carlos Gomez','310320567','Habilitado','Ninguna','JKU766','72212'),
('1283838','Jose Pantoja','319093999','Habilitado','Ninguna','JKU768','72009');


UPDATE manifiestos SET consecutivo="4000", ruta="CARTAGENA", fecha = "2001/10/01",
    cliente ="MONTAGAS", placa ="JKU-768", cisterna = "S-59999", conductor ="MARCO PUIN", cedula = "192345676",
    cantidad = "344000", valor = "12099999" WHERE id = "1";


drop table manifiestos;
insert into manifiestos values ("","30465","Puerto Salgar Vidagas Yumbo","2021-08-12","Vidagas","SXL499","S59865","Jacobo Sanchez Santos","79671549","28.028","4.876.855");
select*from manifiestos;




/*Consultas*/

Select * from manifiestos;

/*SELECT * FROM manifiestos WHERE fecha BETWEEN "2021-10-15" AND current_date() ORDER BY fecha;

select (ruta) from manifiestos where fecha > '2021-01-01' order by ruta;

SELECT * FROM conductores ORDER BY nombre;*/


SELECT ruta, COUNT(ruta) AS num FROM manifiestos where year(fecha) = "2021" GROUP BY ruta order by num desc;

SELECT cliente, COUNT(cliente) AS num FROM manifiestos where year(fecha) = '2021' GROUP BY cliente order by num desc;

SELECT extract(month from fecha) as mes, sum(valor) AS num FROM manifiestos where year(fecha) = '2021' GROUP BY month(fecha) order by month(fecha) desc;

SELECT extract(month from fecha) as mes, sum(cantidad) AS num FROM manifiestos where year(fecha) = '2021' GROUP BY month(fecha) order by month(fecha) desc;

SELECT placa, COUNT(placa) AS num, SUM(valor) AS total FROM manifiestos where year(fecha) = "2021" GROUP BY placa order by num desc;

SELECT conductor, COUNT(conductor) AS cond, SUM(valor) AS totalf FROM manifiestos where year(fecha) = "2021" GROUP BY conductor order by cond desc;







