
--------26/05/2015---------------

ALTER TABLE nombres_cajas
  ADD CONSTRAINT nombres_cajas_nombre_nacional_tipo_caja_contratista_id_key UNIQUE(nombre, nacional, tipo_caja, contratista_id);

ALTER TABLE nombres_cajas ADD COLUMN anho character varying(100);
ALTER TABLE nombres_cajas ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.anho IS 'Año contable y mes'