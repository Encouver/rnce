--17 mayo 2015

ALTER TABLE acciones ALTER COLUMN tipo_accion SET NOT NULL;
ALTER TABLE duraciones_empresas DROP COLUMN "duracion_años";


ALTER TABLE activos.documentos_registrados ALTER COLUMN valor_adquisicion DROP NOT NULL;
