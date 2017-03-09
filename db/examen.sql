drop table if exists usuarios cascade;

create table usuarios (
  id         bigserial   constraint pk_usuarios primary key,
  nombre     varchar(20) not null constraint uq_usuario_unico unique,
  password   char(32)    not null
);

insert into usuarios (nombre, password)
    values ('pepe', md5('pepe'));

drop table if exists aeropuertos cascade;

create table aeropuertos (
  id       bigserial   constraint pk_aeropuertos primary key,
  id_aero  char(3)     constraint uq_aeropuertos_id_aero unique,
  den_aero varchar(40) not null
);

insert into aeropuertos (id_aero, den_aero)
    values ('XRY', 'Jerez'), ('SVQ', 'Sevilla');

drop table if exists companias cascade;

create table companias (
  id       bigserial   constraint pk_companias primary key,
  den_comp varchar(30) not null
);

insert into companias (den_comp)
    values ('Spanair');

drop table if exists vuelos cascade;

create table vuelos (
  id       bigserial    constraint pk_vuelos primary key,
  id_vuelo char(6)      constraint uq_vuelos_id_vuelo unique,
  orig_id  bigint       not null constraint fk_vuelos_aeropuerto_origen
                        references aeropuertos (id)
                        on delete no action on update cascade,
  dest_id  bigint       not null constraint fk_vuelos_aeropuerto_destino
                        references aeropuertos (id)
                        on delete no action on update cascade,
  comp_id  bigint       not null constraint fk_vuelos_companias
                        references companias (id)
                        on delete no action on update cascade,
  salida   timestamp    not null,
  llegada  timestamp    not null,
  plazas   numeric(3)   not null,
  precio   numeric(6,2) not null
);

insert into vuelos (id_vuelo, orig_id, dest_id, comp_id, salida, llegada, plazas, precio)
    values ('SP2223', 1, 2, 1, current_timestamp + '1 day'::interval,
            current_timestamp + '2 day'::interval, 200, 12.50);

drop table if exists reservas cascade;

create table reservas (
  id         bigserial  constraint pk_reservas primary key,
  usuario_id bigint     not null constraint fk_reservas_usuarios
                        references usuarios (id)
                        on delete no action on update cascade,
  vuelo_id   bigint     not null constraint fk_reservas_vuelos
                        references vuelos (id)
                        on delete no action on update cascade,
  asiento    numeric(3) not null,
  fecha_hora timestamp  not null default current_timestamp,
  constraint uq_asiento_unico unique (vuelo_id, asiento)
);

insert into reservas (usuario_id, vuelo_id, asiento, fecha_hora)
    values (1, 1, 5, current_timestamp);
