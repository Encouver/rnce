 ALTER TABLE personas_naturales DROP COLUMN ci;

ALTER TABLE personas_naturales ADD COLUMN ci integer;
COMMENT ON COLUMN personas_naturales.ci IS 'Cedula de identidad de la persona registrada';


ALTER TABLE bancos_contratistas DROP COLUMN num_cuenta;

ALTER TABLE bancos_contratistas ADD COLUMN num_cuenta character varying(255);
ALTER TABLE bancos_contratistas ALTER COLUMN num_cuenta SET NOT NULL;
COMMENT ON COLUMN bancos_contratistas.num_cuenta IS 'Numero de cuenta';


-- ALTER TABLE actividades_economicas DROP COLUMN ppal_experiencia;

ALTER TABLE actividades_economicas ADD COLUMN ppal_experiencia integer;
ALTER TABLE actividades_economicas ALTER COLUMN ppal_experiencia SET NOT NULL;
COMMENT ON COLUMN actividades_economicas.ppal_experiencia IS 'Experiencia de la actividad economica principal';

-- ALTER TABLE actividades_economicas DROP COLUMN comp1_experiencia;

ALTER TABLE actividades_economicas ADD COLUMN comp1_experiencia integer;
ALTER TABLE actividades_economicas ALTER COLUMN comp1_experiencia SET NOT NULL;
COMMENT ON COLUMN actividades_economicas.comp1_experiencia IS 'Experiencia de la actividad economica complementaria 1';

-- ALTER TABLE actividades_economicas DROP COLUMN comp2_experiencia;

ALTER TABLE actividades_economicas ADD COLUMN comp2_experiencia integer;
COMMENT ON COLUMN actividades_economicas.comp2_experiencia IS 'Experiencia de la actividad economica complementaria 2';

ALTER TABLE activos.documentos_registrados DROP COLUMN sys_tipo_documento_id;

DROP TABLE activos.tipos_documentos;

ALTER TABLE duraciones_empresas ALTER COLUMN tiempo_prorroga DROP NOT NULL;


ALTER TABLE actas_constitutivas DROP COLUMN capital_id;

ALTER TABLE acciones DROP COLUMN numero_principal;

ALTER TABLE acciones DROP COLUMN valor_principal;

ALTER TABLE acciones DROP COLUMN capital_id;

ALTER TABLE acciones DROP COLUMN tipo_accion;

ALTER TABLE certificados DROP COLUMN tipo_certificado;

ALTER TABLE certificados DROP COLUMN capital_id;

ALTER TABLE suplementarios DROP COLUMN tipo_suplementario;

ALTER TABLE suplementarios DROP COLUMN capital_id;

DROP TYPE tipo_sus_pag;


ALTER TABLE capitales DROP COLUMN tipo_capital;
 
DROP TYPE tipo_capital;

create type tipo_capital as enum ('PRNCIPAL','PAGO_CAPITAL','APORTE_CAPITALIZAR','AUMENTO_CAPITAL', 'DISMINUCION_CAPITAL','FONDO_EMERGENCIA','REINTEGRO_PERDIDA','VENTA_ACCION','FUSION_EMPRESARIAL');

ALTER TABLE capitales ADD COLUMN tipo_capital tipo_capital;
COMMENT ON COLUMN capitales.tipo_capital IS 'Tipo de capital puede ser PRINCIPAL, PAGO_CAPITAL, APORTE_CAPITALIZAR, AUMENTO_CAPITAL, DISMINUCION_CAPITAL, FONDO_EMERGENCIA, REINTEGRO_PERDIDA,FUSION_EMPRESARIAL';


ALTER TABLE acciones ADD COLUMN tipo_accion tipo_capital;
COMMENT ON COLUMN acciones.tipo_accion IS 'Tipo de accion puede ser PRINCIPAL, PAGO_CAPITAL, AUMENTO_CAPITAL, VENTA_ACCION';

ALTER TABLE certificados ADD COLUMN tipo_certificado tipo_capital;
COMMENT ON COLUMN certificados.tipo_certificado IS 'Tipo de certificado puede ser PRINCIPAL, PAGO_CAPITAL, AUMENTO_CAPITAL, VENTA_ACCION';

ALTER TABLE suplementarios ADD COLUMN tipo_suplementario tipo_capital;
COMMENT ON COLUMN suplementarios.tipo_suplementario IS 'Tipo de suplementario puede ser PRINCIPAL, PAGO_CAPITAL, AUMENTO_CAPITAL, VENTA_ACCION';

ALTER TABLE acciones ADD COLUMN suscrito boolean;
ALTER TABLE acciones ALTER COLUMN suscrito SET NOT NULL;
COMMENT ON COLUMN acciones.suscrito IS 'Si son acciones suscritas true, si son pagadas false';

ALTER TABLE certificados ADD COLUMN suscrito boolean;
ALTER TABLE certificados ALTER COLUMN suscrito SET NOT NULL;
COMMENT ON COLUMN certificados.suscrito IS 'Si son certificados suscritos true, si son pagadas false';

ALTER TABLE suplementarios ADD COLUMN suscrito boolean;
ALTER TABLE suplementarios ALTER COLUMN suscrito SET NOT NULL;
COMMENT ON COLUMN suplementarios.suscrito IS 'Si son certificados suplementarios suscritos true, si son pagadas false';

ALTER TABLE acciones ADD COLUMN acta_constitutiva_id integer;
ALTER TABLE acciones ALTER COLUMN acta_constitutiva_id SET NOT NULL;
COMMENT ON COLUMN acciones.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';

ALTER TABLE acciones
  ADD CONSTRAINT acciones_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE certificados ADD COLUMN acta_constitutiva_id integer;
ALTER TABLE certificados ALTER COLUMN acta_constitutiva_id SET NOT NULL;
COMMENT ON COLUMN certificados.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';

ALTER TABLE certificados
  ADD CONSTRAINT certificados_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE suplementarios ADD COLUMN acta_constitutiva_id integer;
ALTER TABLE suplementarios ALTER COLUMN acta_constitutiva_id SET NOT NULL;
COMMENT ON COLUMN suplementarios.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';

ALTER TABLE suplementarios
  ADD CONSTRAINT suplementarios_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE capitales DROP COLUMN accion;

ALTER TABLE capitales DROP COLUMN certificado;

ALTER TABLE capitales DROP COLUMN suplementario;

ALTER TABLE capitales DROP COLUMN capital_social;

ALTER TABLE capitales DROP COLUMN contratista_id;

ALTER TABLE capitales DROP COLUMN documento_registrado_id;


ALTER TABLE capitales ADD COLUMN acta_constitutiva_id integer;
ALTER TABLE capitales ALTER COLUMN acta_constitutiva_id SET NOT NULL;
COMMENT ON COLUMN capitales.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';

ALTER TABLE capitales
  ADD CONSTRAINT capitales_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


alter table capitales rename column efectivo to efectivo_banco;

ALTER TABLE capitales ADD COLUMN efectivo numeric(38,6);
COMMENT ON COLUMN capitales.efectivo IS 'Monto del efectivo en caso de existir';

-- Table: aportes_capitalizar

-- DROP TABLE aportes_capitalizar;

CREATE TABLE aportes_capitalizar
(
  id serial NOT NULL, -- Clave primaria
  monto_aporte numeric(38,6) NOT NULL, -- Monto del aporte por capitalizar
  fecha_capitalizacion date NOT NULL, -- Fecha estimada para su capitalizacion
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  CONSTRAINT aportes_capitalizar_pkey PRIMARY KEY (id),
  CONSTRAINT aportes_capitalizar_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE aportes_capitalizar
  OWNER TO eureka;
COMMENT ON TABLE aportes_capitalizar
  IS 'Tabla donde se almacenan las aportes por capitalizar asociados a un acta constitutiva';
COMMENT ON COLUMN aportes_capitalizar.id IS 'Clave primaria';
COMMENT ON COLUMN aportes_capitalizar.monto_aporte IS 'Monto del aporte por capitalizar';
COMMENT ON COLUMN aportes_capitalizar.fecha_capitalizacion IS 'Fecha estimada para su capitalizacion';
COMMENT ON COLUMN aportes_capitalizar.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN aportes_capitalizar.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN aportes_capitalizar.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN aportes_capitalizar.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN aportes_capitalizar.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';



-- Table: aumentos_capitales

-- DROP TABLE aumentos_capitales;

CREATE TABLE aumentos_capitales
(
  id serial NOT NULL, -- Clave primaria
  total_accion integer NOT NULL, -- Total numero de acciones
  valor_accion numeric(38,6) NOT NULL, -- Valor de las acciones
  total_capital numeric(38,6) NOT NULL, -- Total capital social una vez aplicado el aumento
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  CONSTRAINT aumentos_capitales_pkey PRIMARY KEY (id),
  CONSTRAINT aumentos_capitales_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE aumentos_capitales
  OWNER TO eureka;
COMMENT ON TABLE aumentos_capitales
  IS 'Tabla donde se almacenan los aumentos de capital asociados a un acta constitutiva';
COMMENT ON COLUMN aumentos_capitales.id IS 'Clave primaria';
COMMENT ON COLUMN aumentos_capitales.total_accion IS 'Total numero de acciones';
COMMENT ON COLUMN aumentos_capitales.valor_accion IS 'Valor de las acciones';
COMMENT ON COLUMN aumentos_capitales.total_capital IS 'Total capital social una vez aplicado el aumento';
COMMENT ON COLUMN aumentos_capitales.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN aumentos_capitales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN aumentos_capitales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN aumentos_capitales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN aumentos_capitales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';



-- Table: correcciones_monetarias

-- DROP TABLE correcciones_monetarias;

CREATE TABLE correcciones_monetarias
(
  id serial NOT NULL, -- Clave primaria
  nuevo_valor numeric(38,6) NOT NULL, -- Valor de la Acción una vez aplicada la corrección
  fecha_aumento date NOT NULL, -- Fecha del aumento
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  valor_accion numeric(38,6) NOT NULL, -- Valor actual de la accion
  variacion_valor numeric(38,6) NOT NULL, -- Variacion en el valor de la accion
  total_accion integer NOT NULL, -- Total numero de acciones
  monto_capital_legal numeric(38,6) NOT NULL, -- Monto del capital social (legal) una vez aplicada la corrección
  CONSTRAINT correcciones_monetarias_pkey PRIMARY KEY (id),
  CONSTRAINT correcciones_monetarias_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE correcciones_monetarias
  OWNER TO eureka;
COMMENT ON TABLE correcciones_monetarias
  IS 'Tabla donde se almacenan los aumentos de capital asociados a un acta constitutiva';
COMMENT ON COLUMN correcciones_monetarias.id IS 'Clave primaria';
COMMENT ON COLUMN correcciones_monetarias.nuevo_valor IS 'Valor de la Acción una vez aplicada la corrección';
COMMENT ON COLUMN correcciones_monetarias.fecha_aumento IS 'Fecha del aumento';
COMMENT ON COLUMN correcciones_monetarias.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN correcciones_monetarias.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN correcciones_monetarias.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN correcciones_monetarias.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN correcciones_monetarias.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN correcciones_monetarias.valor_accion IS 'Valor actual de la accion';
COMMENT ON COLUMN correcciones_monetarias.variacion_valor IS 'Variacion en el valor de la accion';
COMMENT ON COLUMN correcciones_monetarias.total_accion IS 'Total numero de acciones';
COMMENT ON COLUMN correcciones_monetarias.monto_capital_legal IS 'Monto del capital social (legal) una vez aplicada la corrección 
';



create type tipo_disminucion as enum ('SOBRE EL VALOR', 'SOBRE EL NUMERO');


-- Table: acciones_disminuidas

-- DROP TABLE acciones_disminuidas;

CREATE TABLE acciones_disminuidas
(
  id serial NOT NULL, -- Clave primaria
  justificacion text NOT NULL, -- Justificacion de la disminucion
  tipo_disminucion tipo_disminucion NOT NULL, -- Tipo de disminucion puede ser Sobre el valor, sobre la cantidad
  valor_comun numeric(38,6), -- Valor a disminuir
  valor_preferencial numeric(38,6), -- Valor a disminuir
  numero_comun integer, -- Numero a disminuir
  numero_preferencial integer, -- Numero a disminuir
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  valor_comun_actual numeric(38,6), -- Valor una vez aplicada la disminucion
  valor_preferencial_actual numeric(38,6), -- Valor una vez aplicada la disminucion
  numero_comun_actual integer, -- Numero de acciones comunesuna vez aplicada la disminucion
  numero_preferencial_actual integer, -- Numero de acciones preferenciales unavez aplicada la disminucion
  capital_social numeric(38,6) NOT NULL, -- Capital social una vez aplicada ladisminucion
  CONSTRAINT acciones_disminuidas_pkey PRIMARY KEY (id),
  CONSTRAINT acciones_disminuidas_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE acciones_disminuidas
  OWNER TO eureka;
COMMENT ON TABLE acciones_disminuidas
  IS 'Tabla donde se almacenan las acciones disminuidas asociadas a un acta constitutiva';
COMMENT ON COLUMN acciones_disminuidas.id IS 'Clave primaria';
COMMENT ON COLUMN acciones_disminuidas.justificacion IS 'Justificacion de la disminucion';
COMMENT ON COLUMN acciones_disminuidas.tipo_disminucion IS 'Tipo de disminucion puede ser Sobre el valor, sobre la cantidad';
COMMENT ON COLUMN acciones_disminuidas.valor_comun IS 'Valor a disminuir';
COMMENT ON COLUMN acciones_disminuidas.valor_preferencial IS 'Valor a disminuir';
COMMENT ON COLUMN acciones_disminuidas.numero_comun IS 'Numero a disminuir';
COMMENT ON COLUMN acciones_disminuidas.numero_preferencial IS 'Numero a disminuir';
COMMENT ON COLUMN acciones_disminuidas.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN acciones_disminuidas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN acciones_disminuidas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN acciones_disminuidas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN acciones_disminuidas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN acciones_disminuidas.valor_comun_actual IS 'Valor una vez aplicada la disminucion';
COMMENT ON COLUMN acciones_disminuidas.valor_preferencial_actual IS 'Valor una vez aplicada la disminucion';
COMMENT ON COLUMN acciones_disminuidas.numero_comun_actual IS 'Numero de acciones comunesuna vez aplicada la disminucion';
COMMENT ON COLUMN acciones_disminuidas.numero_preferencial_actual IS 'Numero de acciones preferenciales unavez aplicada la disminucion';
COMMENT ON COLUMN acciones_disminuidas.capital_social IS 'Capital social una vez aplicada ladisminucion';


-- Table: certificados_disminuidos

-- DROP TABLE certificados_disminuidos;

CREATE TABLE certificados_disminuidos
(
  id serial NOT NULL, -- Clave primaria
  justificacion text NOT NULL, -- Justificacion de la disminucion
  tipo_disminucion tipo_disminucion NOT NULL, -- Tipo de disminucion puede ser Sobre el valor, sobre la cantidad
  valor_asociacion numeric(38,6), -- Valor a disminuir
  valor_aportacion numeric(38,6), -- Valor a disminuir
  valor_rotativo numeric(38,6), -- Valor a disminuir
  valor_inversion numeric(38,6), -- Valor a disminuir
  numero_asociacion integer, -- Numero a disminuir
  numero_aportacion integer, -- Numero a disminuir
  numero_rotativo integer, -- Numero a disminuir
  numero_inversion integer, -- Numero a disminuir
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  valor_asociacion_actual numeric(38,6), -- Valor del certificado luego de la disminucion
  valor_aportacion_actual numeric(38,6), -- Valor del certificado luego de la disminucion
  valor_rotativo_actual numeric(38,6), -- Valor del certificado luego de la disminucion
  valor_inversion_actual numeric(38,6), -- Valor del certificado luego de la disminucion
  numero_asoacion_actual integer, -- Numero de certificados luego de la disminucion
  numero_aportacion_actual integer, -- Numero de certificados luego de la disminucion
  numero_rotativo_actual numeric(38,6), -- Numero de certificados luego de la disminucion
  numero_inversion_actual numeric(38,6), -- Numero de certificados luego de la disminucion
  capital_social numeric(38,6) NOT NULL, -- Valor del capital social luego de la disminucion
  CONSTRAINT certificados_disminuidos_pkey PRIMARY KEY (id),
  CONSTRAINT certificados_disminuidos_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE certificados_disminuidos
  OWNER TO eureka;
COMMENT ON TABLE certificados_disminuidos
  IS 'Tabla donde se almacenan los certificados disminuidos asociadas a un acta constitutiva';
COMMENT ON COLUMN certificados_disminuidos.id IS 'Clave primaria';
COMMENT ON COLUMN certificados_disminuidos.justificacion IS 'Justificacion de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.tipo_disminucion IS 'Tipo de disminucion puede ser Sobre el valor, sobre la cantidad';
COMMENT ON COLUMN certificados_disminuidos.valor_asociacion IS 'Valor a disminuir';
COMMENT ON COLUMN certificados_disminuidos.valor_aportacion IS 'Valor a disminuir';
COMMENT ON COLUMN certificados_disminuidos.valor_rotativo IS 'Valor a disminuir';
COMMENT ON COLUMN certificados_disminuidos.valor_inversion IS 'Valor a disminuir';
COMMENT ON COLUMN certificados_disminuidos.numero_asociacion IS 'Numero a disminuir';
COMMENT ON COLUMN certificados_disminuidos.numero_aportacion IS 'Numero a disminuir';
COMMENT ON COLUMN certificados_disminuidos.numero_rotativo IS 'Numero a disminuir';
COMMENT ON COLUMN certificados_disminuidos.numero_inversion IS 'Numero a disminuir';
COMMENT ON COLUMN certificados_disminuidos.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN certificados_disminuidos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN certificados_disminuidos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN certificados_disminuidos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN certificados_disminuidos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN certificados_disminuidos.valor_asociacion_actual IS 'Valor del certificado luego de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.valor_aportacion_actual IS 'Valor del certificado luego de la disminucion
';
COMMENT ON COLUMN certificados_disminuidos.valor_rotativo_actual IS 'Valor del certificado luego de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.valor_inversion_actual IS 'Valor del certificado luego de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.numero_asoacion_actual IS 'Numero de certificados luego de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.numero_aportacion_actual IS 'Numero de certificados luego de la disminucion
';
COMMENT ON COLUMN certificados_disminuidos.numero_rotativo_actual IS 'Numero de certificados luego de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.numero_inversion_actual IS 'Numero de certificados luego de la disminucion';
COMMENT ON COLUMN certificados_disminuidos.capital_social IS 'Valor del capital social luego de la disminucion';





-- Table: suplementarios_disminuidos

-- DROP TABLE suplementarios_disminuidos;

CREATE TABLE suplementarios_disminuidos
(
  id serial NOT NULL, -- Clave primaria
  justificacion text NOT NULL, -- Justificacion de la disminucion
  tipo_disminucion tipo_disminucion NOT NULL, -- Tipo de disminucion puede ser Sobre el valor, sobre la cantidad
  valor numeric(38,6), -- Valor a disminuir
  numero integer, -- Numero a disminuir
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  valor_actual numeric(38,6), -- Valor actual del certificado suplementario luego de aplicar la disminucion
  numero_actual integer, -- Numero actual de certificados suplementarios luego de aplicar la disminucion
  capital_social numeric(38,6) NOT NULL, -- Capital social actual luego de aplicar la disminucion
  CONSTRAINT suplementarios_disminuidos_pkey PRIMARY KEY (id),
  CONSTRAINT suplementarios_disminuidos_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE suplementarios_disminuidos
  OWNER TO eureka;
COMMENT ON TABLE suplementarios_disminuidos
  IS 'Tabla donde se almacenan los certificados suplementarios disminuidos asociadas a un acta constitutiva';
COMMENT ON COLUMN suplementarios_disminuidos.id IS 'Clave primaria';
COMMENT ON COLUMN suplementarios_disminuidos.justificacion IS 'Justificacion de la disminucion';
COMMENT ON COLUMN suplementarios_disminuidos.tipo_disminucion IS 'Tipo de disminucion puede ser Sobre el valor, sobre la cantidad';
COMMENT ON COLUMN suplementarios_disminuidos.valor IS 'Valor a disminuir';
COMMENT ON COLUMN suplementarios_disminuidos.numero IS 'Numero a disminuir';
COMMENT ON COLUMN suplementarios_disminuidos.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN suplementarios_disminuidos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN suplementarios_disminuidos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN suplementarios_disminuidos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN suplementarios_disminuidos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN suplementarios_disminuidos.valor_actual IS 'Valor actual del certificado suplementario luego de aplicar la disminucion';
COMMENT ON COLUMN suplementarios_disminuidos.numero_actual IS 'Numero actual de certificados suplementarios luego de aplicar la disminucion';
COMMENT ON COLUMN suplementarios_disminuidos.capital_social IS 'Capital social actual luego de aplicar la disminucion';



-- Table: limitaciones_capitales

-- DROP TABLE limitaciones_capitales;

CREATE TABLE limitaciones_capitales
(
  id serial NOT NULL, -- Clave primaria
  afecta boolean NOT NULL, -- Si afecta o no el capital para saber si esta asociado a la tabla de limitaciones_capitales_afectados
  fecha_cierre date NOT NULL, -- Fecha del ultimo cierre del ejercicio economico
  capital_social numeric(38,6) NOT NULL, -- Capital Social actualizado
  total_patrimonio numeric(38,6) NOT NULL, -- Total patrimonio actualizado
  porcentaje_descapitalizacion double precision NOT NULL, -- Porcentaje de descapitalizacion
  supuesto boolean NOT NULL, -- Supuesto del Artículo 264 del Código de Comercio si es true es supuesto1 sino supuesto2
  monto_perdida numeric(38,6) NOT NULL, -- Monto del Déficit o Pérdida Acumulada
  fecha_limitacion date NOT NULL, -- Fecha de Aplicación de la Limitación
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  capital_social_actualizado numeric(38,6) NOT NULL, -- Capital social actualizado una vez aplicada la limitacion
  certificacion_aporte_id integer NOT NULL, -- Clave foranea a la tabla certificaciones_aportes
  no_afecta boolean NOT NULL, -- Para saber si afecta o no el capital
  reintegro boolean NOT NULL, -- Para saber si es un reintegro
  capital_legal numeric, -- Capital  Social Legal
  saldo_perdida numeric(38,6), -- Saldo del Déficit o Pérdida Acumulada estoy en caso de ser un reintegro
  CONSTRAINT limitaciones_capitales_pkey PRIMARY KEY (id),
  CONSTRAINT limitaciones_capitales_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT limitaciones_capitales_certificacion_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE limitaciones_capitales
  OWNER TO eureka;
COMMENT ON TABLE limitaciones_capitales
  IS 'Tabla donde se almacenan las limitaciones del capital social';
COMMENT ON COLUMN limitaciones_capitales.id IS 'Clave primaria';
COMMENT ON COLUMN limitaciones_capitales.afecta IS 'Si afecta o no el capital para saber si esta asociado a la tabla de limitaciones_capitales_afectados';
COMMENT ON COLUMN limitaciones_capitales.fecha_cierre IS 'Fecha del ultimo cierre del ejercicio economico';
COMMENT ON COLUMN limitaciones_capitales.capital_social IS 'Capital Social actualizado';
COMMENT ON COLUMN limitaciones_capitales.total_patrimonio IS 'Total patrimonio actualizado';
COMMENT ON COLUMN limitaciones_capitales.porcentaje_descapitalizacion IS 'Porcentaje de descapitalizacion';
COMMENT ON COLUMN limitaciones_capitales.supuesto IS 'Supuesto del Artículo 264 del Código de Comercio si es true es supuesto1 sino supuesto2';
COMMENT ON COLUMN limitaciones_capitales.monto_perdida IS 'Monto del Déficit o Pérdida Acumulada';
COMMENT ON COLUMN limitaciones_capitales.fecha_limitacion IS 'Fecha de Aplicación de la Limitación';
COMMENT ON COLUMN limitaciones_capitales.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN limitaciones_capitales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN limitaciones_capitales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN limitaciones_capitales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN limitaciones_capitales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN limitaciones_capitales.capital_social_actualizado IS 'Capital social actualizado una vez aplicada la limitacion';
COMMENT ON COLUMN limitaciones_capitales.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';
COMMENT ON COLUMN limitaciones_capitales.no_afecta IS 'Para saber si afecta o no el capital';
COMMENT ON COLUMN limitaciones_capitales.reintegro IS 'Para saber si es un reintegro';
COMMENT ON COLUMN limitaciones_capitales.capital_legal IS 'Capital  Social Legal';
COMMENT ON COLUMN limitaciones_capitales.saldo_perdida IS 'Saldo del Déficit o Pérdida Acumulada estoy en caso de ser un reintegro
';




-- Table: limitaciones_capitales_afectados

-- DROP TABLE limitaciones_capitales_afectados;

CREATE TABLE limitaciones_capitales_afectados
(
  id serial NOT NULL, -- Clave primaria
  limitacion_capital_id integer NOT NULL, -- Clave foranea a la tabla limitaciones_capitales
  capital_legal numeric(38,6) NOT NULL, -- Capital Social Legal una vez aplicada la Limitación
  valor_accion numeric(38,6) NOT NULL, -- Valor Unitario de las Acciones una vez aplicada la Limitación
  total_accion integer NOT NULL, -- Total Número de Acciones
  valor_accion_actual numeric(38,6) NOT NULL, -- Valor actual de las Acciones
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  capital_legal_actual numeric(38,6) NOT NULL, -- Capital Social Legal una vez aplicada la Limitación
  total_capital numeric(38,6) NOT NULL, -- Total Capital Social una vez aplicada la Limitación
  CONSTRAINT limitaciones_capitales_afectados_pkey PRIMARY KEY (id),
  CONSTRAINT limitaciones_capitales_afectados_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT limitaciones_capitales_afectados_limitacion_id_fkey FOREIGN KEY (limitacion_capital_id)
      REFERENCES limitaciones_capitales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE limitaciones_capitales_afectados
  OWNER TO eureka;
COMMENT ON TABLE limitaciones_capitales_afectados
  IS 'Tabla donde se almacenan las limitaciones de capital que afectal el capital social';
COMMENT ON COLUMN limitaciones_capitales_afectados.id IS 'Clave primaria';
COMMENT ON COLUMN limitaciones_capitales_afectados.limitacion_capital_id IS 'Clave foranea a la tabla limitaciones_capitales';
COMMENT ON COLUMN limitaciones_capitales_afectados.capital_legal IS 'Capital Social Legal una vez aplicada la Limitación';
COMMENT ON COLUMN limitaciones_capitales_afectados.valor_accion IS 'Valor Unitario de las Acciones una vez aplicada la Limitación';
COMMENT ON COLUMN limitaciones_capitales_afectados.total_accion IS 'Total Número de Acciones';
COMMENT ON COLUMN limitaciones_capitales_afectados.valor_accion_actual IS 'Valor actual de las Acciones';
COMMENT ON COLUMN limitaciones_capitales_afectados.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN limitaciones_capitales_afectados.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN limitaciones_capitales_afectados.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN limitaciones_capitales_afectados.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN limitaciones_capitales_afectados.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN limitaciones_capitales_afectados.capital_legal_actual IS 'Capital Social Legal una vez aplicada la Limitación
';
COMMENT ON COLUMN limitaciones_capitales_afectados.total_capital IS 'Total Capital Social una vez aplicada la Limitación';



-- Table: fondos_emergencias

-- DROP TABLE fondos_emergencias;

CREATE TABLE fondos_emergencias
(
  id serial NOT NULL, -- Clave primaria
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  fecha_cierre date NOT NULL, -- Fecha de Ultimo Cierre Económico
  saldo_fondo numeric(38,6) NOT NULL, -- Saldo del Fondo de Emergencia al Cierre del Ejercicio Económico anterior
  monto_perdida numeric(38,6) NOT NULL, -- Monto del Déficit o Pérdida Acumulada
  monto_utilizado numeric(38,6) NOT NULL, -- Monto utilizado del Fondo de Emergencia
  monto_asociados numeric(38,6), -- Monto Aporte de Asociados
  corto_plazo boolean NOT NULL, -- True si es corto plazo, false si es largo plazo
  numero_plazo integer NOT NULL, -- En meses si es corto plazo y en años si es largo plazo
  interes boolean NOT NULL, -- Si gano o no interes
  tasa_interes double precision, -- Tasa de interes en caso de existir
  saldo_fondo_actual numeric(38,6) NOT NULL, -- Saldo del Fondo de Emergencia una vez utilizado
  monto_actual numeric(38,6) NOT NULL, -- Monto del Déficit o Pérdida Acumulada una vez utilizado el Fondo de Emergencia
  CONSTRAINT fondos_emergencias_pkey PRIMARY KEY (id),
  CONSTRAINT fondos_emergencias_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE fondos_emergencias
  OWNER TO eureka;
COMMENT ON TABLE fondos_emergencias
  IS 'Tabla donde se almacenan los fondos de emergencias asociados al acta constitutiva';
COMMENT ON COLUMN fondos_emergencias.id IS 'Clave primaria';
COMMENT ON COLUMN fondos_emergencias.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN fondos_emergencias.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN fondos_emergencias.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN fondos_emergencias.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN fondos_emergencias.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN fondos_emergencias.fecha_cierre IS 'Fecha de Ultimo Cierre Económico';
COMMENT ON COLUMN fondos_emergencias.saldo_fondo IS 'Saldo del Fondo de Emergencia al Cierre del Ejercicio Económico anterior
';
COMMENT ON COLUMN fondos_emergencias.monto_perdida IS 'Monto del Déficit o Pérdida Acumulada
';
COMMENT ON COLUMN fondos_emergencias.monto_utilizado IS 'Monto utilizado del Fondo de Emergencia';
COMMENT ON COLUMN fondos_emergencias.monto_asociados IS 'Monto Aporte de Asociados
';
COMMENT ON COLUMN fondos_emergencias.corto_plazo IS 'True si es corto plazo, false si es largo plazo';
COMMENT ON COLUMN fondos_emergencias.numero_plazo IS 'En meses si es corto plazo y en años si es largo plazo';
COMMENT ON COLUMN fondos_emergencias.interes IS 'Si gano o no interes';
COMMENT ON COLUMN fondos_emergencias.tasa_interes IS 'Tasa de interes en caso de existir';
COMMENT ON COLUMN fondos_emergencias.saldo_fondo_actual IS 'Saldo del Fondo de Emergencia una vez utilizado
';
COMMENT ON COLUMN fondos_emergencias.monto_actual IS 'Monto del Déficit o Pérdida Acumulada una vez utilizado el Fondo de Emergencia';

ALTER TABLE accionistas_otros ADD COLUMN repr_legal_vigencia date;
COMMENT ON COLUMN accionistas_otros.repr_legal_vigencia IS ' Vigencia del Representante Legal
';

ALTER TABLE capitales ADD COLUMN certificacion_aporte_id integer;
ALTER TABLE capitales ALTER COLUMN certificacion_aporte_id SET NOT NULL;
COMMENT ON COLUMN capitales.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';

ALTER TABLE capitales
  ADD CONSTRAINT capitales_certificacion_aporte_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE certificaciones_aportes DROP COLUMN capital_id;


-- Table: empresas_fusionadas

-- DROP TABLE empresas_fusionadas;

CREATE TABLE empresas_fusionadas
(
  id serial NOT NULL, -- Clave primaria
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  natural_juridica_id integer NOT NULL, -- Clave foranea a la tabla naturales_juridicas
  certificacion_aporte_id integer NOT NULL, -- Clave foranea a la tabla certificaciones_aportes
  documento_registrado_id integer NOT NULL, -- Clave foranea a la tabla documentos_registrados del esquema activo
  CONSTRAINT empresas_fusionadas_pkey PRIMARY KEY (id),
  CONSTRAINT empresas_fusionadas_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT empresas_fusionadas_certificacion_aporte_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT empresas_fusionadas_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT empresas_fusionadas_naturales_id_fkey FOREIGN KEY (natural_juridica_id)
      REFERENCES sys_naturales_juridicas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE empresas_fusionadas
  OWNER TO eureka;
COMMENT ON TABLE empresas_fusionadas
  IS 'Tabla donde se almacenan las empresas fusionadas asoaicadas al acta constitutiva';
COMMENT ON COLUMN empresas_fusionadas.id IS 'Clave primaria';
COMMENT ON COLUMN empresas_fusionadas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN empresas_fusionadas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN empresas_fusionadas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN empresas_fusionadas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN empresas_fusionadas.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN empresas_fusionadas.natural_juridica_id IS 'Clave foranea a la tabla naturales_juridicas';
COMMENT ON COLUMN empresas_fusionadas.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';
COMMENT ON COLUMN empresas_fusionadas.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados del esquema activo';


-- Table: decretos_div_excedentes

-- DROP TABLE decretos_div_excedentes;

CREATE TABLE decretos_div_excedentes
(
  id serial NOT NULL, -- Clave primaria
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  fecha_cierre date NOT NULL, -- Fecha del Cierre Económico
  utilidad_acumulada numeric(38,6) NOT NULL, -- Utilidad Acumulada
  utilidad_decretada numeric(38,6) NOT NULL, -- Utilidad Decretada
  CONSTRAINT decretos_div_excedentes_pkey PRIMARY KEY (id),
  CONSTRAINT decretos_div_excedentes_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE decretos_div_excedentes
  OWNER TO eureka;
COMMENT ON TABLE decretos_div_excedentes
  IS 'Tabla donde se almacenan los Decreto de Dividendos en Efectivo o Decreto de Excedentes (Nombre valido para las Cooperativas
';
COMMENT ON COLUMN decretos_div_excedentes.id IS 'Clave primaria';
COMMENT ON COLUMN decretos_div_excedentes.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN decretos_div_excedentes.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN decretos_div_excedentes.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN decretos_div_excedentes.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN decretos_div_excedentes.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN decretos_div_excedentes.fecha_cierre IS 'Fecha del Cierre Económico';
COMMENT ON COLUMN decretos_div_excedentes.utilidad_acumulada IS 'Utilidad Acumulada';
COMMENT ON COLUMN decretos_div_excedentes.utilidad_decretada IS 'Utilidad Decretada
';



-- Table: pagos_accionistas_decretos

-- DROP TABLE pagos_accionistas_decretos;

CREATE TABLE pagos_accionistas_decretos
(
  id integer NOT NULL DEFAULT nextval('pagos_accionistas_decreto_id_seq'::regclass), -- Clave primaria
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  decreto_div_excedente_id integer NOT NULL, -- Clave foranea a la tabla decretos_div_excedentes
  accionista_id integer NOT NULL, -- Clave foranea a la tabla accionistas_otros
  monto_cancelado numeric(38,6) NOT NULL, -- Monto cancelado
  fecha date NOT NULL, -- Fecha
  cheque boolean NOT NULL, -- True si es un cheque
  transferencia boolean NOT NULL, -- True si es una transferencia
  efectivo boolean NOT NULL, -- True si es una transferencia
  numero_cheque character varying(100), -- Numero de cheque
  numero_transferencia character varying(100), -- Numero de transferencia
  recibo_pago character varying(100), -- Numero de recibo de pago
  CONSTRAINT pagos_accionistas_decreto_pkey PRIMARY KEY (id),
  CONSTRAINT pago_accionista_id_accionista_otro_id_fkey FOREIGN KEY (accionista_id)
      REFERENCES accionistas_otros (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT pagos_accionistas_decreto_div_excedente_id_fkey FOREIGN KEY (decreto_div_excedente_id)
      REFERENCES decretos_div_excedentes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE pagos_accionistas_decretos
  OWNER TO eureka;
COMMENT ON TABLE pagos_accionistas_decretos
  IS 'Tabla donde se almacenan Detalle del Pago por Accionista / Asociado';
COMMENT ON COLUMN pagos_accionistas_decretos.id IS 'Clave primaria';
COMMENT ON COLUMN pagos_accionistas_decretos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN pagos_accionistas_decretos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN pagos_accionistas_decretos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN pagos_accionistas_decretos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN pagos_accionistas_decretos.decreto_div_excedente_id IS 'Clave foranea a la tabla decretos_div_excedentes';
COMMENT ON COLUMN pagos_accionistas_decretos.accionista_id IS 'Clave foranea a la tabla accionistas_otros';
COMMENT ON COLUMN pagos_accionistas_decretos.monto_cancelado IS 'Monto cancelado';
COMMENT ON COLUMN pagos_accionistas_decretos.fecha IS 'Fecha';
COMMENT ON COLUMN pagos_accionistas_decretos.cheque IS 'True si es un cheque';
COMMENT ON COLUMN pagos_accionistas_decretos.transferencia IS 'True si es una transferencia';
COMMENT ON COLUMN pagos_accionistas_decretos.efectivo IS 'True si es una transferencia';
COMMENT ON COLUMN pagos_accionistas_decretos.numero_cheque IS 'Numero de cheque';
COMMENT ON COLUMN pagos_accionistas_decretos.numero_transferencia IS 'Numero de transferencia';
COMMENT ON COLUMN pagos_accionistas_decretos.recibo_pago IS 'Numero de recibo de pago';

-- Table: modificaciones_balances

-- DROP TABLE modificaciones_balances;

CREATE TABLE modificaciones_balances
(
  id serial NOT NULL, -- Clave primaria
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  acta_constitutiva_id integer NOT NULL, -- Clave foranea a la tabla actas_constitutivas
  fecha_cierre date NOT NULL, -- Fecha del Cierre Económico:
  aprobado boolean NOT NULL, -- Resultado de la Discusión, true si fue aprobado, false si fue modificado
  CONSTRAINT modificaciones_balances_pkey PRIMARY KEY (id),
  CONSTRAINT modificaciones_balances_acta_constitutiva_id_fkey FOREIGN KEY (acta_constitutiva_id)
      REFERENCES actas_constitutivas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE modificaciones_balances
  OWNER TO eureka;
COMMENT ON TABLE modificaciones_balances
  IS 'Tabla donde se almacena Discusión y Aprobación o Modificación de Balances';
COMMENT ON COLUMN modificaciones_balances.id IS 'Clave primaria';
COMMENT ON COLUMN modificaciones_balances.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN modificaciones_balances.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN modificaciones_balances.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN modificaciones_balances.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN modificaciones_balances.acta_constitutiva_id IS 'Clave foranea a la tabla actas_constitutivas';
COMMENT ON COLUMN modificaciones_balances.fecha_cierre IS 'Fecha del Cierre Económico: 
';
COMMENT ON COLUMN modificaciones_balances.aprobado IS 'Resultado de la Discusión, true si fue aprobado, false si fue modificado';



ALTER TABLE actas_constitutivas ADD COLUMN capital_principal boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN capital_principal SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.capital_principal IS 'Si posee informacion en la tabla acciones o certificados o suplementarios';

ALTER TABLE actas_constitutivas ADD COLUMN pago_capital boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN pago_capital SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.pago_capital IS 'Si es true se busca informacion en acciones, certificados o suplmentarios';


ALTER TABLE actas_constitutivas ADD COLUMN aporte_capitalizar boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN aporte_capitalizar SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.aporte_capitalizar IS 'True se busca informacion en la tabla aportes_capitalizar';

ALTER TABLE actas_constitutivas ADD COLUMN aumento_capital boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN aumento_capital SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.aumento_capital IS 'True se busca informacion en la tabla aumento_capital';

ALTER TABLE actas_constitutivas ADD COLUMN coreccion_monetaria boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN coreccion_monetaria SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.coreccion_monetaria IS 'True se busca informacion en la tabla correciones_monetarias';

ALTER TABLE actas_constitutivas ADD COLUMN disminucion_capital boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN disminucion_capital SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.disminucion_capital IS 'True se busca informacion en la tabla acciones_disminuidas_ certificados_disminuidos o suplemenatrios_disminuidos';

ALTER TABLE actas_constitutivas ADD COLUMN limitacion_capital boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN limitacion_capital SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.limitacion_capital IS 'True se busca informacion en la tabla limitaciones_capitales';


ALTER TABLE actas_constitutivas ADD COLUMN limitacion_capital_afectado boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN limitacion_capital_afectado SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.limitacion_capital_afectado IS 'True se busca informacion en la tabla limitaciones_capitales_afectados';


ALTER TABLE actas_constitutivas ADD COLUMN fondo_emergencia boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN fondo_emergencia SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.fondo_emergencia IS 'True se busca informacion en la tabla fondos_emergencias';

ALTER TABLE actas_constitutivas ADD COLUMN reintegro_perdida boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN reintegro_perdida SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.reintegro_perdida IS 'True se busca informacion en la tabla limitaciones_capitales';

ALTER TABLE actas_constitutivas ADD COLUMN venta_accion boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN venta_accion SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.venta_accion IS 'True se busca informacion en la tabla acciones, certificados, suplementarios';

ALTER TABLE actas_constitutivas ADD COLUMN fusion_empresarial boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN fusion_empresarial SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.fusion_empresarial IS 'True se busca informacion en la tabla fusiones_empresariales';

ALTER TABLE actas_constitutivas ADD COLUMN decreto_div_excedente boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN decreto_div_excedente SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.decreto_div_excedente IS 'True se busca informacion en la tabla decreto_div_excedentes';


ALTER TABLE actas_constitutivas ADD COLUMN modificacion_balance boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN modificacion_balance SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.modificacion_balance IS 'True se busca informacion en la tabla modificaciones_balances';

ALTER TABLE comisarios_auditores ADD COLUMN auditor boolean;
ALTER TABLE comisarios_auditores ALTER COLUMN auditor SET NOT NULL;
COMMENT ON COLUMN comisarios_auditores.auditor IS 'True si es un contador auditor';


ALTER TABLE comisarios_auditores ADD COLUMN responsable_contabilidad boolean;
ALTER TABLE comisarios_auditores ALTER COLUMN responsable_contabilidad SET NOT NULL;
COMMENT ON COLUMN comisarios_auditores.responsable_contabilidad IS 'Si es responsable de la contabilidad';


ALTER TABLE comisarios_auditores ADD COLUMN informe_conversion boolean;
ALTER TABLE comisarios_auditores ALTER COLUMN informe_conversion SET NOT NULL;
COMMENT ON COLUMN comisarios_auditores.informe_conversion IS 'True si es el profesional que realiza el informe de conversion';


ALTER TABLE comisarios_auditores ADD COLUMN natural_juridica_id integer;
ALTER TABLE comisarios_auditores ALTER COLUMN natural_juridica_id SET NOT NULL;
COMMENT ON COLUMN comisarios_auditores.natural_juridica_id IS 'Clave foranea a la tabla sys_naturales_juridicas';

