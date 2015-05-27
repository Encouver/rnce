/**************     26/05/2015 *************/


-- Column: contratista_id

ALTER TABLE nombres_cajas DROP COLUMN IF EXISTS contratista_id;

ALTER TABLE nombres_cajas ADD COLUMN contratista_id integer;
ALTER TABLE nombres_cajas ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.contratista_id IS 'Clave foranea al contratista';

ALTER TABLE nombres_cajas
ADD FOREIGN KEY (contratista_id) REFERENCES contratistas (id) ON UPDATE CASCADE ON DELETE NO ACTION;

-- Column: anho

ALTER TABLE nombres_cajas DROP COLUMN IF EXISTS anho;

ALTER TABLE nombres_cajas ADD COLUMN anho character varying(100);
ALTER TABLE nombres_cajas ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.anho IS 'Año contable y mes';


ALTER TABLE nombres_cajas
  DROP COLUMN contratistas_id;




/**************     27/05/2015 *************/

ALTER TABLE activos.vehiculos RENAME anho  TO anho_vehiculo;
COMMENT ON COLUMN activos.vehiculos.anho_vehiculo
IS 'Año del vehiculo.';
COMMENT ON COLUMN activos.vehiculos.anho_vehiculo IS 'Año del vehiculo.';
