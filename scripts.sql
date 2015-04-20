-- Column: sys_status

ALTER TABLE TABLA DROP COLUMN sys_status;

ALTER TABLE TABLA ADD COLUMN sys_status boolean;
ALTER TABLE TABLA ALTER COLUMN sys_status SET NOT NULL;
ALTER TABLE TABLA ALTER COLUMN sys_status SET DEFAULT true;
COMMENT ON COLUMN TABLA.sys_status IS 'Estatus interno del sistema';

ALTER TABLE TABLA DROP COLUMN sys_fecha;

-- Column: sys_creado_el

-- ALTER TABLE TABLA DROP COLUMN sys_creado_el;

ALTER TABLE TABLA ADD COLUMN sys_creado_el timestamp with time zone;
ALTER TABLE TABLA ALTER COLUMN sys_creado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_creado_el IS 'Fecha de creación del registro.';


-- Column: sys_actualizado_el

-- ALTER TABLE TABLA DROP COLUMN sys_actualizado_el;

ALTER TABLE TABLA ADD COLUMN sys_actualizado_el timestamp with time zone;
--ALTER TABLE TABLA ALTER COLUMN sys_actualizado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_actualizado_el IS 'Fecha de última actualización del registro.';


-- Column: sys_finalizado_el

-- ALTER TABLE TABLA DROP COLUMN sys_finalizado_el;

ALTER TABLE TABLA ADD COLUMN sys_finalizado_el timestamp with time zone;
--ALTER TABLE TABLA ALTER COLUMN sys_finalizado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

