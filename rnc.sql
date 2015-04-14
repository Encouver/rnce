PGDMP     %                    s            rnc    9.3.2    9.3.2 �   n
           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            o
           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            p
           1262    411381    rnc    DATABASE     �   CREATE DATABASE rnc WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Bolivarian Republic of Venezuela.1252' LC_CTYPE = 'Spanish_Bolivarian Republic of Venezuela.1252';
    DROP DATABASE rnc;
             eureka    false                        2615    411408    activos    SCHEMA        CREATE SCHEMA activos;
    DROP SCHEMA activos;
             eureka    false                        2615    411409    cuentas    SCHEMA        CREATE SCHEMA cuentas;
    DROP SCHEMA cuentas;
             eureka    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            q
           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    5            r
           0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    5                       3079    11750    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            s
           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    267            �            1259    411792    activos_biologicos    TABLE     Y  CREATE TABLE activos_biologicos (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    catidad integer NOT NULL,
    certificado boolean DEFAULT false,
    num_certificado character varying(255),
    detalles character varying(255) NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
 '   DROP TABLE activos.activos_biologicos;
       activos         postgres    false    7            t
           0    0    TABLE activos_biologicos    COMMENT     h   COMMENT ON TABLE activos_biologicos IS 'Tabla que almacena los activos biologicos de los contratistas';
            activos       postgres    false    221            u
           0    0    COLUMN activos_biologicos.id    COMMENT     =   COMMENT ON COLUMN activos_biologicos.id IS 'Clave primaria';
            activos       postgres    false    221            v
           0    0 !   COLUMN activos_biologicos.bien_id    COMMENT     S   COMMENT ON COLUMN activos_biologicos.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       postgres    false    221            w
           0    0 !   COLUMN activos_biologicos.catidad    COMMENT     P   COMMENT ON COLUMN activos_biologicos.catidad IS 'Numero de activos biologicos';
            activos       postgres    false    221            x
           0    0 %   COLUMN activos_biologicos.certificado    COMMENT     d   COMMENT ON COLUMN activos_biologicos.certificado IS 'Si el activo biologico esta o no certificado';
            activos       postgres    false    221            y
           0    0 )   COLUMN activos_biologicos.num_certificado    COMMENT     o   COMMENT ON COLUMN activos_biologicos.num_certificado IS 'Si el activo esta certifiado, numero de certificado';
            activos       postgres    false    221            z
           0    0 "   COLUMN activos_biologicos.detalles    COMMENT     c   COMMENT ON COLUMN activos_biologicos.detalles IS 'Informacion de complemento al activo biologico';
            activos       postgres    false    221            {
           0    0 $   COLUMN activos_biologicos.sys_status    COMMENT     R   COMMENT ON COLUMN activos_biologicos.sys_status IS 'Estatus interno del sistema';
            activos       postgres    false    221            �            1259    411790    activos_biologicos_id_seq    SEQUENCE     {   CREATE SEQUENCE activos_biologicos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE activos.activos_biologicos_id_seq;
       activos       postgres    false    7    221            |
           0    0    activos_biologicos_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE activos_biologicos_id_seq OWNED BY activos_biologicos.id;
            activos       postgres    false    220            �            1259    411812    activos_intangibles    TABLE       CREATE TABLE activos_intangibles (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    certificado_registro character varying(255),
    fecha_registro date,
    vigencia date NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
 (   DROP TABLE activos.activos_intangibles;
       activos         eureka    false    7            }
           0    0    TABLE activos_intangibles    COMMENT     j   COMMENT ON TABLE activos_intangibles IS 'Tabla que almacena los activos intangibles de los contratistas';
            activos       eureka    false    223            ~
           0    0    COLUMN activos_intangibles.id    COMMENT     >   COMMENT ON COLUMN activos_intangibles.id IS 'Clave primaria';
            activos       eureka    false    223            
           0    0 "   COLUMN activos_intangibles.bien_id    COMMENT     T   COMMENT ON COLUMN activos_intangibles.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    223            �
           0    0 /   COLUMN activos_intangibles.certificado_registro    COMMENT     Y   COMMENT ON COLUMN activos_intangibles.certificado_registro IS 'Certificado de registro';
            activos       eureka    false    223            �
           0    0 )   COLUMN activos_intangibles.fecha_registro    COMMENT     c   COMMENT ON COLUMN activos_intangibles.fecha_registro IS 'Fecha de registro del activo intangible';
            activos       eureka    false    223            �
           0    0 #   COLUMN activos_intangibles.vigencia    COMMENT     T   COMMENT ON COLUMN activos_intangibles.vigencia IS 'Vigencia del activo intangible';
            activos       eureka    false    223            �
           0    0 %   COLUMN activos_intangibles.sys_status    COMMENT     S   COMMENT ON COLUMN activos_intangibles.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    223            �            1259    411810    activos_intangibles_id_seq    SEQUENCE     |   CREATE SEQUENCE activos_intangibles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE activos.activos_intangibles_id_seq;
       activos       eureka    false    223    7            �
           0    0    activos_intangibles_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE activos_intangibles_id_seq OWNED BY activos_intangibles.id;
            activos       eureka    false    222            �            1259    411913    avaluos    TABLE     e  CREATE TABLE avaluos (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    valor numeric(38,6) NOT NULL,
    fecha_informe date NOT NULL,
    perito_id integer NOT NULL,
    gremio_id integer NOT NULL,
    num_inscripcion_gremio character varying(255) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE activos.avaluos;
       activos         eureka    false    7            �
           0    0    TABLE avaluos    COMMENT     ^   COMMENT ON TABLE avaluos IS 'Tabla donde se registran todos los avaluos de los contratistas';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.id    COMMENT     2   COMMENT ON COLUMN avaluos.id IS 'Clave primaria';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.bien_id    COMMENT     H   COMMENT ON COLUMN avaluos.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.valor    COMMENT     7   COMMENT ON COLUMN avaluos.valor IS 'Valor del avaluo';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.fecha_informe    COMMENT     K   COMMENT ON COLUMN avaluos.fecha_informe IS 'Fecha del informe del Avaluo';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.perito_id    COMMENT     V   COMMENT ON COLUMN avaluos.perito_id IS 'Clave foranea a la tabla Personas_Naturales';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.gremio_id    COMMENT     O   COMMENT ON COLUMN avaluos.gremio_id IS 'Clave foranea a la tabla Sys_gremios';
            activos       eureka    false    233            �
           0    0 %   COLUMN avaluos.num_inscripcion_gremio    COMMENT     W   COMMENT ON COLUMN avaluos.num_inscripcion_gremio IS 'Numero de incripcion del gremio';
            activos       eureka    false    233            �
           0    0    COLUMN avaluos.sys_status    COMMENT     G   COMMENT ON COLUMN avaluos.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    233            �            1259    411911    avaluos_id_seq    SEQUENCE     p   CREATE SEQUENCE avaluos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE activos.avaluos_id_seq;
       activos       eureka    false    7    233            �
           0    0    avaluos_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE avaluos_id_seq OWNED BY avaluos.id;
            activos       eureka    false    232            �            1259    411698    bienes    TABLE     �  CREATE TABLE bienes (
    id integer NOT NULL,
    sys_tipo_bien_id integer NOT NULL,
    principio_contable integer NOT NULL,
    depreciable boolean DEFAULT true NOT NULL,
    deterioro boolean DEFAULT true NOT NULL,
    detalle character varying(255),
    origen character varying(255) NOT NULL,
    fecha_origen date NOT NULL,
    contratista_id integer NOT NULL,
    propio boolean DEFAULT true NOT NULL
);
    DROP TABLE activos.bienes;
       activos         eureka    false    7            �
           0    0    TABLE bienes    COMMENT     W   COMMENT ON TABLE bienes IS 'Tabla donde se almacenan los bienes que posee la empresa';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.id    COMMENT     1   COMMENT ON COLUMN bienes.id IS 'Clave primaria';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.sys_tipo_bien_id    COMMENT     W   COMMENT ON COLUMN bienes.sys_tipo_bien_id IS 'Clave foranea a la tabla sys_tipo_bien';
            activos       eureka    false    211            �
           0    0     COLUMN bienes.principio_contable    COMMENT     ]   COMMENT ON COLUMN bienes.principio_contable IS 'Principio contable que aplica para el bien';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.depreciable    COMMENT     J   COMMENT ON COLUMN bienes.depreciable IS 'Si el bien es depreciable o no';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.deterioro    COMMENT     I   COMMENT ON COLUMN bienes.deterioro IS 'Si el bien tiene deterioro o no';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.detalle    COMMENT     B   COMMENT ON COLUMN bienes.detalle IS 'Descripcion complementaria';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.origen    COMMENT     6   COMMENT ON COLUMN bienes.origen IS 'Origen del bien';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.fecha_origen    COMMENT     M   COMMENT ON COLUMN bienes.fecha_origen IS 'Fecha de la adquisicion del bien';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.contratista_id    COMMENT     K   COMMENT ON COLUMN bienes.contratista_id IS 'Clave foranea al contratista';
            activos       eureka    false    211            �
           0    0    COLUMN bienes.propio    COMMENT     @   COMMENT ON COLUMN bienes.propio IS 'Si el bien es o no propio';
            activos       eureka    false    211            �            1259    411696    bienes_id_seq    SEQUENCE     o   CREATE SEQUENCE bienes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE activos.bienes_id_seq;
       activos       eureka    false    7    211            �
           0    0    bienes_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE bienes_id_seq OWNED BY bienes.id;
            activos       eureka    false    210                       1259    412193    construcciones_inmuebles    TABLE     P  CREATE TABLE construcciones_inmuebles (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    area_construccion character varying(255) NOT NULL,
    porcentaje_ejecucion numeric(38,6) NOT NULL,
    monto_ejecutado numeric(38,6) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
 -   DROP TABLE activos.construcciones_inmuebles;
       activos         eureka    false    7            �
           0    0    TABLE construcciones_inmuebles    COMMENT     a   COMMENT ON TABLE construcciones_inmuebles IS 'Tabla que contiene los inmuebles en construccion';
            activos       eureka    false    259            �
           0    0 "   COLUMN construcciones_inmuebles.id    COMMENT     C   COMMENT ON COLUMN construcciones_inmuebles.id IS 'Clave primaria';
            activos       eureka    false    259            �
           0    0 '   COLUMN construcciones_inmuebles.bien_id    COMMENT     Y   COMMENT ON COLUMN construcciones_inmuebles.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    259            �
           0    0 *   COLUMN construcciones_inmuebles.sys_status    COMMENT     X   COMMENT ON COLUMN construcciones_inmuebles.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    259                       1259    412191    construcciones_inmuebles_id_seq    SEQUENCE     �   CREATE SEQUENCE construcciones_inmuebles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE activos.construcciones_inmuebles_id_seq;
       activos       eureka    false    7    259            �
           0    0    construcciones_inmuebles_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE construcciones_inmuebles_id_seq OWNED BY construcciones_inmuebles.id;
            activos       eureka    false    258            �            1259    411721    datos_importacion    TABLE     Z  CREATE TABLE datos_importacion (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    num_guia_nac character varying(100) NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    gastos_mon_extranjera numeric(38,6) NOT NULL,
    sys_moneda_id integer NOT NULL,
    tasa_cambio numeric(38,6) NOT NULL,
    gastos_imp_nacional numeric(38,6) NOT NULL,
    otros_costros_imp_instalacion numeric(38,6) NOT NULL,
    total_costo_adquisicion numeric(38,6) NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    pais_origen_id integer NOT NULL
);
 &   DROP TABLE activos.datos_importacion;
       activos         eureka    false    7            �
           0    0    TABLE datos_importacion    COMMENT     R   COMMENT ON TABLE datos_importacion IS 'Tabla que lleva adquisicion / Imporatada';
            activos       eureka    false    213            �
           0    0    COLUMN datos_importacion.id    COMMENT     <   COMMENT ON COLUMN datos_importacion.id IS 'Clave primaria';
            activos       eureka    false    213            �
           0    0     COLUMN datos_importacion.bien_id    COMMENT     R   COMMENT ON COLUMN datos_importacion.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    213            �
           0    0 %   COLUMN datos_importacion.num_guia_nac    COMMENT     V   COMMENT ON COLUMN datos_importacion.num_guia_nac IS 'Numero de guia nacionalizacion';
            activos       eureka    false    213            �
           0    0 *   COLUMN datos_importacion.costo_adquisicion    COMMENT     T   COMMENT ON COLUMN datos_importacion.costo_adquisicion IS 'Costo de la adquisicion';
            activos       eureka    false    213            �
           0    0 .   COLUMN datos_importacion.gastos_mon_extranjera    COMMENT     \   COMMENT ON COLUMN datos_importacion.gastos_mon_extranjera IS 'Gastos en moneda extranjera';
            activos       eureka    false    213            �
           0    0 &   COLUMN datos_importacion.sys_moneda_id    COMMENT     ]   COMMENT ON COLUMN datos_importacion.sys_moneda_id IS 'Clave foranea a la tabla Sys_monedas';
            activos       eureka    false    213            �
           0    0 $   COLUMN datos_importacion.tasa_cambio    COMMENT     ]   COMMENT ON COLUMN datos_importacion.tasa_cambio IS 'Tasa de cambio al momento de la compra';
            activos       eureka    false    213            �
           0    0 6   COLUMN datos_importacion.otros_costros_imp_instalacion    COMMENT     a   COMMENT ON COLUMN datos_importacion.otros_costros_imp_instalacion IS 'Otros gastos importacion';
            activos       eureka    false    213            �
           0    0 0   COLUMN datos_importacion.total_costo_adquisicion    COMMENT     c   COMMENT ON COLUMN datos_importacion.total_costo_adquisicion IS 'Total de costo de la adquisicion';
            activos       eureka    false    213            �
           0    0 #   COLUMN datos_importacion.sys_status    COMMENT     Q   COMMENT ON COLUMN datos_importacion.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    213            �
           0    0 '   COLUMN datos_importacion.pais_origen_id    COMMENT     ~   COMMENT ON COLUMN datos_importacion.pais_origen_id IS 'Pais de origen de la importacion clave foranea a la tabla Sys_Paises';
            activos       eureka    false    213            �            1259    411719    datos_importacion_id_seq    SEQUENCE     z   CREATE SEQUENCE datos_importacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE activos.datos_importacion_id_seq;
       activos       eureka    false    7    213            �
           0    0    datos_importacion_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE datos_importacion_id_seq OWNED BY datos_importacion.id;
            activos       eureka    false    212            �            1259    411938    depresiaciones_amortizaciones    TABLE     f  CREATE TABLE depresiaciones_amortizaciones (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    costo_adquisicion_avaluo numeric(38,6) NOT NULL,
    fecha_adquisicion_avaluo date NOT NULL,
    vida_util integer NOT NULL,
    valor_residual numeric(38,6) NOT NULL,
    valor_depreciar numeric(38,6) NOT NULL,
    tasa_anual numeric(38,6) NOT NULL,
    unidades_estimadas integer NOT NULL,
    bs_unidad numeric(38,6) NOT NULL,
    unidades_producidas_periodo integer NOT NULL,
    unidades_consumidas integer NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
 2   DROP TABLE activos.depresiaciones_amortizaciones;
       activos         eureka    false    7            �
           0    0 #   TABLE depresiaciones_amortizaciones    COMMENT        COMMENT ON TABLE depresiaciones_amortizaciones IS 'Tabla que recoge todas las amortizaciones y depresiaciones de los activos';
            activos       eureka    false    235            �
           0    0 '   COLUMN depresiaciones_amortizaciones.id    COMMENT     G   COMMENT ON COLUMN depresiaciones_amortizaciones.id IS 'Clave foranea';
            activos       eureka    false    235            �
           0    0 ,   COLUMN depresiaciones_amortizaciones.bien_id    COMMENT     ^   COMMENT ON COLUMN depresiaciones_amortizaciones.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    235            �
           0    0 =   COLUMN depresiaciones_amortizaciones.costo_adquisicion_avaluo    COMMENT     e   COMMENT ON COLUMN depresiaciones_amortizaciones.costo_adquisicion_avaluo IS 'Costro de adquisicion';
            activos       eureka    false    235            �
           0    0 =   COLUMN depresiaciones_amortizaciones.fecha_adquisicion_avaluo    COMMENT     o   COMMENT ON COLUMN depresiaciones_amortizaciones.fecha_adquisicion_avaluo IS 'Fecha de adquisicion del avaluo';
            activos       eureka    false    235            �
           0    0 .   COLUMN depresiaciones_amortizaciones.vida_util    COMMENT     ^   COMMENT ON COLUMN depresiaciones_amortizaciones.vida_util IS 'Vida util, expresado en meses';
            activos       eureka    false    235            �
           0    0 /   COLUMN depresiaciones_amortizaciones.sys_status    COMMENT     ]   COMMENT ON COLUMN depresiaciones_amortizaciones.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    235            �            1259    411936 $   depresiaciones_amortizaciones_id_seq    SEQUENCE     �   CREATE SEQUENCE depresiaciones_amortizaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE activos.depresiaciones_amortizaciones_id_seq;
       activos       eureka    false    7    235            �
           0    0 $   depresiaciones_amortizaciones_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE depresiaciones_amortizaciones_id_seq OWNED BY depresiaciones_amortizaciones.id;
            activos       eureka    false    234            �            1259    412035    desincorporacion_activos    TABLE     5  CREATE TABLE desincorporacion_activos (
    id integer NOT NULL,
    sys_motivo_id integer NOT NULL,
    fecha date NOT NULL,
    precio_venta numeric(38,6) DEFAULT 0 NOT NULL,
    valor_neto_libro numeric(8,6) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
 -   DROP TABLE activos.desincorporacion_activos;
       activos         eureka    false    7            �
           0    0 "   COLUMN desincorporacion_activos.id    COMMENT     C   COMMENT ON COLUMN desincorporacion_activos.id IS 'Clave primaria';
            activos       eureka    false    245            �
           0    0 -   COLUMN desincorporacion_activos.sys_motivo_id    COMMENT     d   COMMENT ON COLUMN desincorporacion_activos.sys_motivo_id IS 'Clave foranea a la tabla sys_motivos';
            activos       eureka    false    245            �
           0    0 *   COLUMN desincorporacion_activos.sys_status    COMMENT     X   COMMENT ON COLUMN desincorporacion_activos.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    245            �            1259    412033    desincorporacion_activos_id_seq    SEQUENCE     �   CREATE SEQUENCE desincorporacion_activos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE activos.desincorporacion_activos_id_seq;
       activos       eureka    false    7    245            �
           0    0    desincorporacion_activos_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE desincorporacion_activos_id_seq OWNED BY desincorporacion_activos.id;
            activos       eureka    false    244            �            1259    412005 
   deterioros    TABLE     x  CREATE TABLE deterioros (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    valor_razonable numeric(38,6) NOT NULL,
    costo_disposicion numeric(38,6) NOT NULL,
    valor_uso numeric(38,6) NOT NULL,
    acumulado_ejer_ant numeric(38,6),
    ejercicios_anteriores numeric(38,6),
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE activos.deterioros;
       activos         eureka    false    7            �
           0    0    TABLE deterioros    COMMENT     U   COMMENT ON TABLE deterioros IS 'Tabla donde se almacena el deterioro de los actvos';
            activos       eureka    false    241            �
           0    0    COLUMN deterioros.id    COMMENT     5   COMMENT ON COLUMN deterioros.id IS 'Clave primaria';
            activos       eureka    false    241            �
           0    0    COLUMN deterioros.bien_id    COMMENT     K   COMMENT ON COLUMN deterioros.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    241            �
           0    0 !   COLUMN deterioros.valor_razonable    COMMENT     M   COMMENT ON COLUMN deterioros.valor_razonable IS 'Costo del valor razonable';
            activos       eureka    false    241            �
           0    0    COLUMN deterioros.sys_status    COMMENT     J   COMMENT ON COLUMN deterioros.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    241            �            1259    412003    deterioros_id_seq    SEQUENCE     s   CREATE SEQUENCE deterioros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE activos.deterioros_id_seq;
       activos       eureka    false    7    241            �
           0    0    deterioros_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE deterioros_id_seq OWNED BY deterioros.id;
            activos       eureka    false    240            �            1259    411872    documentos_registrados    TABLE     '  CREATE TABLE documentos_registrados (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    sys_tipo_documento_id integer NOT NULL,
    sys_tipo_registro_id integer NOT NULL,
    circunscripcion character varying(255) NOT NULL,
    num_registro_notaria character varying(255) NOT NULL,
    tomo character varying(100) NOT NULL,
    folio character varying(100) NOT NULL,
    fecha_registro date NOT NULL,
    valor_adquisicion numeric(38,6) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
 +   DROP TABLE activos.documentos_registrados;
       activos         eureka    false    7            �
           0    0    TABLE documentos_registrados    COMMENT     \   COMMENT ON TABLE documentos_registrados IS 'Tabla que almacena los documentos registrados';
            activos       eureka    false    229            �
           0    0     COLUMN documentos_registrados.id    COMMENT     A   COMMENT ON COLUMN documentos_registrados.id IS 'Clave primaria';
            activos       eureka    false    229            �
           0    0 ,   COLUMN documentos_registrados.contratista_id    COMMENT     d   COMMENT ON COLUMN documentos_registrados.contratista_id IS 'Clave foranea a la tabla Contratistas';
            activos       eureka    false    229            �
           0    0 3   COLUMN documentos_registrados.sys_tipo_documento_id    COMMENT     p   COMMENT ON COLUMN documentos_registrados.sys_tipo_documento_id IS 'Clave foranea a la tabla Tipo de documento';
            activos       eureka    false    229            �
           0    0 2   COLUMN documentos_registrados.sys_tipo_registro_id    COMMENT     k   COMMENT ON COLUMN documentos_registrados.sys_tipo_registro_id IS 'Clave foranea a la tabla Tipo Registro';
            activos       eureka    false    229            �
           0    0 -   COLUMN documentos_registrados.circunscripcion    COMMENT     k   COMMENT ON COLUMN documentos_registrados.circunscripcion IS 'Circunscripcion donde registro el documento';
            activos       eureka    false    229            �
           0    0 2   COLUMN documentos_registrados.num_registro_notaria    COMMENT     d   COMMENT ON COLUMN documentos_registrados.num_registro_notaria IS 'Numero del documento registrado';
            activos       eureka    false    229            �
           0    0 "   COLUMN documentos_registrados.tomo    COMMENT     R   COMMENT ON COLUMN documentos_registrados.tomo IS 'Tomo del documento registrado';
            activos       eureka    false    229            �
           0    0 #   COLUMN documentos_registrados.folio    COMMENT     T   COMMENT ON COLUMN documentos_registrados.folio IS 'Folio del documento registrado';
            activos       eureka    false    229            �
           0    0 ,   COLUMN documentos_registrados.fecha_registro    COMMENT     _   COMMENT ON COLUMN documentos_registrados.fecha_registro IS 'Fecha del registro del documento';
            activos       eureka    false    229            �
           0    0 /   COLUMN documentos_registrados.valor_adquisicion    COMMENT     V   COMMENT ON COLUMN documentos_registrados.valor_adquisicion IS 'Costo de adquisicion';
            activos       eureka    false    229            �
           0    0 (   COLUMN documentos_registrados.sys_status    COMMENT     V   COMMENT ON COLUMN documentos_registrados.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    229            �            1259    411870    documentos_registrados_id_seq    SEQUENCE        CREATE SEQUENCE documentos_registrados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE activos.documentos_registrados_id_seq;
       activos       eureka    false    7    229            �
           0    0    documentos_registrados_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE documentos_registrados_id_seq OWNED BY documentos_registrados.id;
            activos       eureka    false    228                       1259    412208    fabricaciones_muebles    TABLE     =  CREATE TABLE fabricaciones_muebles (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    cantidad numeric(38,6) NOT NULL,
    porcentaje_fabricacion numeric(38,6) NOT NULL,
    monto_ejecutado numeric(38,6) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
 *   DROP TABLE activos.fabricaciones_muebles;
       activos         eureka    false    7            �
           0    0    TABLE fabricaciones_muebles    COMMENT     [   COMMENT ON TABLE fabricaciones_muebles IS 'Tabla que contiene los muebles en fabricacion';
            activos       eureka    false    261            �
           0    0    COLUMN fabricaciones_muebles.id    COMMENT     @   COMMENT ON COLUMN fabricaciones_muebles.id IS 'Clave primaria';
            activos       eureka    false    261            �
           0    0 $   COLUMN fabricaciones_muebles.bien_id    COMMENT     V   COMMENT ON COLUMN fabricaciones_muebles.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    261            �
           0    0 '   COLUMN fabricaciones_muebles.sys_status    COMMENT     U   COMMENT ON COLUMN fabricaciones_muebles.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    261                       1259    412206    fabricaciones_muebles_id_seq    SEQUENCE     ~   CREATE SEQUENCE fabricaciones_muebles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE activos.fabricaciones_muebles_id_seq;
       activos       eureka    false    261    7            �
           0    0    fabricaciones_muebles_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE fabricaciones_muebles_id_seq OWNED BY fabricaciones_muebles.id;
            activos       eureka    false    260            �            1259    411842    facturas    TABLE     �  CREATE TABLE facturas (
    id integer NOT NULL,
    num_factura character varying(255) NOT NULL,
    proveedor_id integer NOT NULL,
    fecha_emision date NOT NULL,
    imprenta_id integer NOT NULL,
    fecha_emision_talonario date NOT NULL,
    comprador_id integer NOT NULL,
    base_imponible_gravable numeric(38,6) NOT NULL,
    execto numeric(38,6),
    iva numeric(38,6) NOT NULL,
    contratista_id integer NOT NULL,
    bien_id integer NOT NULL
);
    DROP TABLE activos.facturas;
       activos         eureka    false    7            �
           0    0    TABLE facturas    COMMENT     ^   COMMENT ON TABLE facturas IS 'Tabla que almacena las facturas de bienes de los contratistas';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.id    COMMENT     3   COMMENT ON COLUMN facturas.id IS 'Clave primaria';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.num_factura    COMMENT     L   COMMENT ON COLUMN facturas.num_factura IS 'Numero de la factura del bien.';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.proveedor_id    COMMENT     Z   COMMENT ON COLUMN facturas.proveedor_id IS 'Clave foranea a la tabla personas_juridicas';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.fecha_emision    COMMENT     N   COMMENT ON COLUMN facturas.fecha_emision IS 'Fecha de imision de la factura';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.imprenta_id    COMMENT     Y   COMMENT ON COLUMN facturas.imprenta_id IS 'Clave foranea a la tabla personas_juridicas';
            activos       eureka    false    227            �
           0    0 '   COLUMN facturas.fecha_emision_talonario    COMMENT     X   COMMENT ON COLUMN facturas.fecha_emision_talonario IS 'Fecha de emision del talonario';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.comprador_id    COMMENT     Z   COMMENT ON COLUMN facturas.comprador_id IS 'Clave foranea a la tabla personas_juridicas';
            activos       eureka    false    227            �
           0    0 '   COLUMN facturas.base_imponible_gravable    COMMENT     ^   COMMENT ON COLUMN facturas.base_imponible_gravable IS 'Base imponible gravable del impuesto';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.iva    COMMENT     =   COMMENT ON COLUMN facturas.iva IS 'Impuesto valor agregado';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.contratista_id    COMMENT     U   COMMENT ON COLUMN facturas.contratista_id IS 'Clave foranea a la tabla contratista';
            activos       eureka    false    227            �
           0    0    COLUMN facturas.bien_id    COMMENT     I   COMMENT ON COLUMN facturas.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    227            �            1259    411840    facturas_id_seq    SEQUENCE     q   CREATE SEQUENCE facturas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE activos.facturas_id_seq;
       activos       eureka    false    7    227            �
           0    0    facturas_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE facturas_id_seq OWNED BY facturas.id;
            activos       eureka    false    226            �            1259    411741 	   inmuebles    TABLE     �  CREATE TABLE inmuebles (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    descripcion text,
    direccion_ubicacion character varying(255) NOT NULL,
    ficha_catastral character varying(255) NOT NULL,
    zonificacion character varying(255) NOT NULL,
    extension character varying(255) NOT NULL,
    titulo_supletorio character varying(255),
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE activos.inmuebles;
       activos         eureka    false    7            �
           0    0    COLUMN inmuebles.id    COMMENT     3   COMMENT ON COLUMN inmuebles.id IS 'Clave foranea';
            activos       eureka    false    215            �
           0    0    COLUMN inmuebles.bien_id    COMMENT     J   COMMENT ON COLUMN inmuebles.bien_id IS 'Clave foranea a la tabla bienes';
            activos       eureka    false    215            �
           0    0    COLUMN inmuebles.descripcion    COMMENT     G   COMMENT ON COLUMN inmuebles.descripcion IS 'Descripcion del inmueble';
            activos       eureka    false    215            �
           0    0 $   COLUMN inmuebles.direccion_ubicacion    COMMENT     Z   COMMENT ON COLUMN inmuebles.direccion_ubicacion IS 'Direccion de ubicacion del inmueble';
            activos       eureka    false    215            �
           0    0     COLUMN inmuebles.ficha_catastral    COMMENT     O   COMMENT ON COLUMN inmuebles.ficha_catastral IS 'Ficha catastral del inmueble';
            activos       eureka    false    215            �
           0    0    COLUMN inmuebles.zonificacion    COMMENT     I   COMMENT ON COLUMN inmuebles.zonificacion IS 'Zonificacion del inmueble';
            activos       eureka    false    215            �
           0    0    COLUMN inmuebles.extension    COMMENT     C   COMMENT ON COLUMN inmuebles.extension IS 'extension del inmueble';
            activos       eureka    false    215            �
           0    0    COLUMN inmuebles.sys_status    COMMENT     I   COMMENT ON COLUMN inmuebles.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    215            �            1259    411739    inmuebles_id_seq    SEQUENCE     r   CREATE SEQUENCE inmuebles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE activos.inmuebles_id_seq;
       activos       eureka    false    215    7            �
           0    0    inmuebles_id_seq    SEQUENCE OWNED BY     7   ALTER SEQUENCE inmuebles_id_seq OWNED BY inmuebles.id;
            activos       eureka    false    214            �            1259    411827    licencia    TABLE     �   CREATE TABLE licencia (
    id integer NOT NULL,
    activo_intangible_id integer NOT NULL,
    numero character varying(255),
    fecha_adquisicion date,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE activos.licencia;
       activos         eureka    false    7            �
           0    0    TABLE licencia    COMMENT     C   COMMENT ON TABLE licencia IS 'Tabla de licencias del contratista';
            activos       eureka    false    225            �
           0    0    COLUMN licencia.id    COMMENT     3   COMMENT ON COLUMN licencia.id IS 'Clave primaria';
            activos       eureka    false    225            �
           0    0 $   COLUMN licencia.activo_intangible_id    COMMENT     c   COMMENT ON COLUMN licencia.activo_intangible_id IS 'Clave foranea a la tabla Activos intangibles';
            activos       eureka    false    225            �
           0    0    COLUMN licencia.numero    COMMENT     >   COMMENT ON COLUMN licencia.numero IS 'Numero de la licencia';
            activos       eureka    false    225            �
           0    0 !   COLUMN licencia.fecha_adquisicion    COMMENT     W   COMMENT ON COLUMN licencia.fecha_adquisicion IS 'Fecha de adquisicion de la licencia';
            activos       eureka    false    225            �
           0    0    COLUMN licencia.sys_status    COMMENT     H   COMMENT ON COLUMN licencia.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    225            �            1259    411825    licencia_id_seq    SEQUENCE     q   CREATE SEQUENCE licencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE activos.licencia_id_seq;
       activos       eureka    false    225    7            �
           0    0    licencia_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE licencia_id_seq OWNED BY licencia.id;
            activos       eureka    false    224            �            1259    411968    medicion    TABLE     �  CREATE TABLE medicion (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    medicion_activo boolean DEFAULT true,
    sys_metodo_medicion_id integer NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now(),
    aplica_deterioro boolean DEFAULT false,
    vinculado_proceso_productivo boolean DEFAULT false,
    vinculado_proceso_ventas boolean DEFAULT false
);
    DROP TABLE activos.medicion;
       activos         eureka    false    7            �
           0    0    TABLE medicion    COMMENT     2   COMMENT ON TABLE medicion IS 'Tabla de medicion';
            activos       eureka    false    239            �
           0    0    COLUMN medicion.id    COMMENT     3   COMMENT ON COLUMN medicion.id IS 'Clave primaria';
            activos       eureka    false    239            �
           0    0    COLUMN medicion.bien_id    COMMENT     I   COMMENT ON COLUMN medicion.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    239            �
           0    0 &   COLUMN medicion.sys_metodo_medicion_id    COMMENT     e   COMMENT ON COLUMN medicion.sys_metodo_medicion_id IS 'Clave foranea a la tabla sys metodo medicion';
            activos       eureka    false    239            �
           0    0    COLUMN medicion.sys_status    COMMENT     H   COMMENT ON COLUMN medicion.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    239            �            1259    411966    medicion_id_seq    SEQUENCE     q   CREATE SEQUENCE medicion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE activos.medicion_id_seq;
       activos       eureka    false    7    239            �
           0    0    medicion_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE medicion_id_seq OWNED BY medicion.id;
            activos       eureka    false    238            �            1259    412050    mejoras_propiedades    TABLE     �  CREATE TABLE mejoras_propiedades (
    id integer NOT NULL,
    clasificacion character varying(255) NOT NULL,
    sys_tipo_bien_id integer NOT NULL,
    principio_contable_id integer NOT NULL,
    depreciacion boolean DEFAULT true,
    deterioro boolean DEFAULT true,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now(),
    bien_id integer NOT NULL,
    monto numeric(38,6) NOT NULL,
    fecha date NOT NULL,
    capitalizable boolean DEFAULT true NOT NULL
);
 (   DROP TABLE activos.mejoras_propiedades;
       activos         eureka    false    7            �
           0    0    COLUMN mejoras_propiedades.id    COMMENT     =   COMMENT ON COLUMN mejoras_propiedades.id IS 'Clave foranea';
            activos       eureka    false    247            �
           0    0 +   COLUMN mejoras_propiedades.sys_tipo_bien_id    COMMENT     d   COMMENT ON COLUMN mejoras_propiedades.sys_tipo_bien_id IS 'Clave foranea a la tabla Sys_tipo_bien';
            activos       eureka    false    247            �
           0    0 0   COLUMN mejoras_propiedades.principio_contable_id    COMMENT     o   COMMENT ON COLUMN mejoras_propiedades.principio_contable_id IS 'Clave foranea a la tabla Formas_organizacion';
            activos       eureka    false    247            �
           0    0 %   COLUMN mejoras_propiedades.sys_status    COMMENT     S   COMMENT ON COLUMN mejoras_propiedades.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    247            �
           0    0 "   COLUMN mejoras_propiedades.bien_id    COMMENT     T   COMMENT ON COLUMN mejoras_propiedades.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    247            �            1259    412048    mejoras_propiedad_id_seq    SEQUENCE     z   CREATE SEQUENCE mejoras_propiedad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE activos.mejoras_propiedad_id_seq;
       activos       eureka    false    7    247            �
           0    0    mejoras_propiedad_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE mejoras_propiedad_id_seq OWNED BY mejoras_propiedades.id;
            activos       eureka    false    246            �            1259    411759    muebles    TABLE     P  CREATE TABLE muebles (
    id integer NOT NULL,
    bien_id integer NOT NULL,
    marca character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    serial character varying(255) NOT NULL,
    cantiad integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE activos.muebles;
       activos         eureka    false    7            �
           0    0    TABLE muebles    COMMENT     X   COMMENT ON TABLE muebles IS 'Tabla que almacena todos los muebles de los contratistas';
            activos       eureka    false    217            �
           0    0    COLUMN muebles.id    COMMENT     2   COMMENT ON COLUMN muebles.id IS 'Clave primaria';
            activos       eureka    false    217            �
           0    0    COLUMN muebles.bien_id    COMMENT     H   COMMENT ON COLUMN muebles.bien_id IS 'Clave foranea a la tabla Bienes';
            activos       eureka    false    217            �
           0    0    COLUMN muebles.marca    COMMENT     9   COMMENT ON COLUMN muebles.marca IS 'Marca del inmueble';
            activos       eureka    false    217            �
           0    0    COLUMN muebles.modelo    COMMENT     ;   COMMENT ON COLUMN muebles.modelo IS 'Modelo del inmueble';
            activos       eureka    false    217            �
           0    0    COLUMN muebles.serial    COMMENT     ;   COMMENT ON COLUMN muebles.serial IS 'Serial del inmueble';
            activos       eureka    false    217                        0    0    COLUMN muebles.cantiad    COMMENT     1   COMMENT ON COLUMN muebles.cantiad IS 'Cantidad';
            activos       eureka    false    217                       0    0    COLUMN muebles.sys_status    COMMENT     G   COMMENT ON COLUMN muebles.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    217            �            1259    411757    muebles_id_seq    SEQUENCE     p   CREATE SEQUENCE muebles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE activos.muebles_id_seq;
       activos       eureka    false    217    7                       0    0    muebles_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE muebles_id_seq OWNED BY muebles.id;
            activos       eureka    false    216                       1259    412167    sys_ciudades    TABLE       CREATE TABLE sys_ciudades (
    id integer NOT NULL,
    sys_estado_id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    codigo_postal character varying(255) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
 !   DROP TABLE activos.sys_ciudades;
       activos         eureka    false    7                       0    0    TABLE sys_ciudades    COMMENT     l   COMMENT ON TABLE sys_ciudades IS 'Tabla que almacena las ciudades del sistema referenciando a los estados';
            activos       eureka    false    257                       0    0    COLUMN sys_ciudades.id    COMMENT     6   COMMENT ON COLUMN sys_ciudades.id IS 'Clave foranea';
            activos       eureka    false    257                       0    0 !   COLUMN sys_ciudades.sys_estado_id    COMMENT     W   COMMENT ON COLUMN sys_ciudades.sys_estado_id IS 'Clave foranea a latabla Sys_estados';
            activos       eureka    false    257                       0    0    COLUMN sys_ciudades.nombre    COMMENT     @   COMMENT ON COLUMN sys_ciudades.nombre IS 'Nombre de la ciudad';
            activos       eureka    false    257                       0    0    COLUMN sys_ciudades.sys_status    COMMENT     L   COMMENT ON COLUMN sys_ciudades.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    257                        1259    412165    sys_ciudades_id_seq    SEQUENCE     u   CREATE SEQUENCE sys_ciudades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE activos.sys_ciudades_id_seq;
       activos       eureka    false    257    7                       0    0    sys_ciudades_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE sys_ciudades_id_seq OWNED BY sys_ciudades.id;
            activos       eureka    false    256            �            1259    412106    sys_clasificaciones_bienes    TABLE     �   CREATE TABLE sys_clasificaciones_bienes (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion character varying(255),
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
 /   DROP TABLE activos.sys_clasificaciones_bienes;
       activos         eureka    false    7            	           0    0     TABLE sys_clasificaciones_bienes    COMMENT     d   COMMENT ON TABLE sys_clasificaciones_bienes IS 'Tabla que contiene las clasificaciones de un bien';
            activos       eureka    false    251            
           0    0 $   COLUMN sys_clasificaciones_bienes.id    COMMENT     D   COMMENT ON COLUMN sys_clasificaciones_bienes.id IS 'Clave foranea';
            activos       eureka    false    251                       0    0 (   COLUMN sys_clasificaciones_bienes.nombre    COMMENT     U   COMMENT ON COLUMN sys_clasificaciones_bienes.nombre IS 'Nombre de la clasificacion';
            activos       eureka    false    251                       0    0 -   COLUMN sys_clasificaciones_bienes.descripcion    COMMENT     U   COMMENT ON COLUMN sys_clasificaciones_bienes.descripcion IS 'Informacion adicional';
            activos       eureka    false    251                       0    0 ,   COLUMN sys_clasificaciones_bienes.sys_status    COMMENT     Z   COMMENT ON COLUMN sys_clasificaciones_bienes.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    251            �            1259    412104    sys_clasificaciones_bien_id_seq    SEQUENCE     �   CREATE SEQUENCE sys_clasificaciones_bien_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE activos.sys_clasificaciones_bien_id_seq;
       activos       eureka    false    7    251                       0    0    sys_clasificaciones_bien_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE sys_clasificaciones_bien_id_seq OWNED BY sys_clasificaciones_bienes.id;
            activos       eureka    false    250            �            1259    412152    sys_estados    TABLE     �   CREATE TABLE sys_estados (
    id integer NOT NULL,
    sys_pais_id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
     DROP TABLE activos.sys_estados;
       activos         eureka    false    7                       0    0    TABLE sys_estados    COMMENT     a   COMMENT ON TABLE sys_estados IS 'Tabla donde se almacenan los estados relacionados con su pais';
            activos       eureka    false    255                       0    0    COLUMN sys_estados.id    COMMENT     5   COMMENT ON COLUMN sys_estados.id IS 'Clave foranea';
            activos       eureka    false    255                       0    0    COLUMN sys_estados.sys_pais_id    COMMENT     T   COMMENT ON COLUMN sys_estados.sys_pais_id IS 'Clave foranea a la tabla Sys_Paises';
            activos       eureka    false    255                       0    0    COLUMN sys_estados.nombre    COMMENT     =   COMMENT ON COLUMN sys_estados.nombre IS 'Nombre del estado';
            activos       eureka    false    255                       0    0    COLUMN sys_estados.sys_status    COMMENT     K   COMMENT ON COLUMN sys_estados.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    255            �            1259    412150    sys_estados_id_seq    SEQUENCE     t   CREATE SEQUENCE sys_estados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE activos.sys_estados_id_seq;
       activos       eureka    false    255    7                       0    0    sys_estados_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE sys_estados_id_seq OWNED BY sys_estados.id;
            activos       eureka    false    254            �            1259    411683    sys_formas_org    TABLE     �   CREATE TABLE sys_formas_org (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
 #   DROP TABLE activos.sys_formas_org;
       activos         eureka    false    7                       0    0    TABLE sys_formas_org    COMMENT     y   COMMENT ON TABLE sys_formas_org IS 'Tabla que almacena las formas de orgnizacion que pueden existir dentro del sistema';
            activos       eureka    false    209                       0    0    COLUMN sys_formas_org.id    COMMENT     9   COMMENT ON COLUMN sys_formas_org.id IS 'Clave primaria';
            activos       eureka    false    209                       0    0    COLUMN sys_formas_org.nombre    COMMENT     Q   COMMENT ON COLUMN sys_formas_org.nombre IS 'Nombre de la forma de organizacion';
            activos       eureka    false    209                       0    0 !   COLUMN sys_formas_org.descripcion    COMMENT     e   COMMENT ON COLUMN sys_formas_org.descripcion IS 'Descripcion adicional de la forma de organizacion';
            activos       eureka    false    209                       0    0     COLUMN sys_formas_org.sys_status    COMMENT     N   COMMENT ON COLUMN sys_formas_org.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    209            �            1259    411681    sys_formas_org_id_seq    SEQUENCE     w   CREATE SEQUENCE sys_formas_org_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE activos.sys_formas_org_id_seq;
       activos       eureka    false    209    7                       0    0    sys_formas_org_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE sys_formas_org_id_seq OWNED BY sys_formas_org.id;
            activos       eureka    false    208            �            1259    411895    sys_gremios    TABLE     �   CREATE TABLE sys_gremios (
    id integer NOT NULL,
    persona_juridica_id integer NOT NULL,
    direccion text,
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
     DROP TABLE activos.sys_gremios;
       activos         eureka    false    7                       0    0    TABLE sys_gremios    COMMENT     d   COMMENT ON TABLE sys_gremios IS 'Tabla donde almacena todos los gremios disponibles en el sistema';
            activos       eureka    false    231                       0    0    COLUMN sys_gremios.id    COMMENT     6   COMMENT ON COLUMN sys_gremios.id IS 'Clave primaria';
            activos       eureka    false    231                       0    0 &   COLUMN sys_gremios.persona_juridica_id    COMMENT     d   COMMENT ON COLUMN sys_gremios.persona_juridica_id IS 'Clave foranea a la tabla Personas Juridicas';
            activos       eureka    false    231                       0    0    COLUMN sys_gremios.direccion    COMMENT     I   COMMENT ON COLUMN sys_gremios.direccion IS 'Informacion complementaria';
            activos       eureka    false    231                       0    0    COLUMN sys_gremios.sys_status    COMMENT     K   COMMENT ON COLUMN sys_gremios.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    231            �            1259    411893    sys_gremios_id_seq    SEQUENCE     t   CREATE SEQUENCE sys_gremios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE activos.sys_gremios_id_seq;
       activos       eureka    false    7    231                        0    0    sys_gremios_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE sys_gremios_id_seq OWNED BY sys_gremios.id;
            activos       eureka    false    230            �            1259    411953    sys_metodo_medicion    TABLE     �   CREATE TABLE sys_metodo_medicion (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion character varying(255),
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
 (   DROP TABLE activos.sys_metodo_medicion;
       activos         eureka    false    7            !           0    0    TABLE sys_metodo_medicion    COMMENT     b   COMMENT ON TABLE sys_metodo_medicion IS 'Tabla que almacena los metodos de medicion del sistema';
            activos       eureka    false    237            "           0    0    COLUMN sys_metodo_medicion.id    COMMENT     >   COMMENT ON COLUMN sys_metodo_medicion.id IS 'Clave primaria';
            activos       eureka    false    237            #           0    0 !   COLUMN sys_metodo_medicion.nombre    COMMENT     Q   COMMENT ON COLUMN sys_metodo_medicion.nombre IS 'Nombre del metodo de medicion';
            activos       eureka    false    237            $           0    0 &   COLUMN sys_metodo_medicion.descripcion    COMMENT     N   COMMENT ON COLUMN sys_metodo_medicion.descripcion IS 'Informacion adicional';
            activos       eureka    false    237            %           0    0 %   COLUMN sys_metodo_medicion.sys_status    COMMENT     R   COMMENT ON COLUMN sys_metodo_medicion.sys_status IS 'Esatus interno del sistema';
            activos       eureka    false    237            �            1259    411951    sys_metodo_medicion_id_seq    SEQUENCE     |   CREATE SEQUENCE sys_metodo_medicion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE activos.sys_metodo_medicion_id_seq;
       activos       eureka    false    237    7            &           0    0    sys_metodo_medicion_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE sys_metodo_medicion_id_seq OWNED BY sys_metodo_medicion.id;
            activos       eureka    false    236            �            1259    412020    sys_motivios    TABLE     �   CREATE TABLE sys_motivios (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion character varying(255),
    sys_status boolean DEFAULT true,
    sys_fecha time with time zone DEFAULT now()
);
 !   DROP TABLE activos.sys_motivios;
       activos         eureka    false    7            '           0    0    TABLE sys_motivios    COMMENT     d   COMMENT ON TABLE sys_motivios IS 'Tabla donde se almacenan todos los posibles motivos del sistema';
            activos       eureka    false    243            (           0    0    COLUMN sys_motivios.id    COMMENT     7   COMMENT ON COLUMN sys_motivios.id IS 'Clave primaria';
            activos       eureka    false    243            )           0    0    COLUMN sys_motivios.nombre    COMMENT     >   COMMENT ON COLUMN sys_motivios.nombre IS 'Nombre del motivo';
            activos       eureka    false    243            *           0    0    COLUMN sys_motivios.descripcion    COMMENT     L   COMMENT ON COLUMN sys_motivios.descripcion IS 'Informacion complementaria';
            activos       eureka    false    243            +           0    0    COLUMN sys_motivios.sys_status    COMMENT     L   COMMENT ON COLUMN sys_motivios.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    243            �            1259    412018    sys_motivios_id_seq    SEQUENCE     u   CREATE SEQUENCE sys_motivios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE activos.sys_motivios_id_seq;
       activos       eureka    false    243    7            ,           0    0    sys_motivios_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE sys_motivios_id_seq OWNED BY sys_motivios.id;
            activos       eureka    false    242            �            1259    412140 
   sys_paises    TABLE     �   CREATE TABLE sys_paises (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
    DROP TABLE activos.sys_paises;
       activos         eureka    false    7            -           0    0    TABLE sys_paises    COMMENT     `   COMMENT ON TABLE sys_paises IS 'Tabla que almacena todos los paises disponibles en el sistema';
            activos       eureka    false    253            .           0    0    COLUMN sys_paises.id    COMMENT     5   COMMENT ON COLUMN sys_paises.id IS 'Clave primaria';
            activos       eureka    false    253            /           0    0    COLUMN sys_paises.nombre    COMMENT     :   COMMENT ON COLUMN sys_paises.nombre IS 'Nombre del pais';
            activos       eureka    false    253            0           0    0    COLUMN sys_paises.sys_status    COMMENT     J   COMMENT ON COLUMN sys_paises.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    253            �            1259    412138    sys_paises_id_seq    SEQUENCE     s   CREATE SEQUENCE sys_paises_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE activos.sys_paises_id_seq;
       activos       eureka    false    253    7            1           0    0    sys_paises_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE sys_paises_id_seq OWNED BY sys_paises.id;
            activos       eureka    false    252            �            1259    411669    sys_tipos_bienes    TABLE       CREATE TABLE sys_tipos_bienes (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    descripcion character varying(255),
    sys_clasificacion_bien_id integer NOT NULL
);
 %   DROP TABLE activos.sys_tipos_bienes;
       activos         postgres    false    7            2           0    0    COLUMN sys_tipos_bienes.id    COMMENT     ;   COMMENT ON COLUMN sys_tipos_bienes.id IS 'Clave primaria';
            activos       postgres    false    207            3           0    0    COLUMN sys_tipos_bienes.nombre    COMMENT     I   COMMENT ON COLUMN sys_tipos_bienes.nombre IS 'Nombre del tipo de bien.';
            activos       postgres    false    207            4           0    0 "   COLUMN sys_tipos_bienes.sys_status    COMMENT     P   COMMENT ON COLUMN sys_tipos_bienes.sys_status IS 'Estatus interno del sistema';
            activos       postgres    false    207            5           0    0 #   COLUMN sys_tipos_bienes.descripcion    COMMENT     K   COMMENT ON COLUMN sys_tipos_bienes.descripcion IS 'Informacion adicional';
            activos       postgres    false    207            6           0    0 1   COLUMN sys_tipos_bienes.sys_clasificacion_bien_id    COMMENT     v   COMMENT ON COLUMN sys_tipos_bienes.sys_clasificacion_bien_id IS 'Clave foranea a la tabla Sys_Clasificacion_bien_id';
            activos       postgres    false    207            �            1259    411667    sys_tipo_bien_id_seq    SEQUENCE     v   CREATE SEQUENCE sys_tipo_bien_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE activos.sys_tipo_bien_id_seq;
       activos       postgres    false    207    7            7           0    0    sys_tipo_bien_id_seq    SEQUENCE OWNED BY     B   ALTER SEQUENCE sys_tipo_bien_id_seq OWNED BY sys_tipos_bienes.id;
            activos       postgres    false    206            �            1259    411655    sys_tipos_documentos    TABLE     �   CREATE TABLE sys_tipos_documentos (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    estado boolean DEFAULT true NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
 )   DROP TABLE activos.sys_tipos_documentos;
       activos         eureka    false    7            8           0    0    COLUMN sys_tipos_documentos.id    COMMENT     >   COMMENT ON COLUMN sys_tipos_documentos.id IS 'Clave foranea';
            activos       eureka    false    205            9           0    0 "   COLUMN sys_tipos_documentos.nombre    COMMENT     J   COMMENT ON COLUMN sys_tipos_documentos.nombre IS 'Nombre del documento ';
            activos       eureka    false    205            :           0    0 "   COLUMN sys_tipos_documentos.estado    COMMENT     ^   COMMENT ON COLUMN sys_tipos_documentos.estado IS 'Si el documento se encuentra activo o no.';
            activos       eureka    false    205            ;           0    0 &   COLUMN sys_tipos_documentos.sys_status    COMMENT     T   COMMENT ON COLUMN sys_tipos_documentos.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    205            �            1259    411653    sys_tipo_documento_id_seq    SEQUENCE     {   CREATE SEQUENCE sys_tipo_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE activos.sys_tipo_documento_id_seq;
       activos       eureka    false    205    7            <           0    0    sys_tipo_documento_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE sys_tipo_documento_id_seq OWNED BY sys_tipos_documentos.id;
            activos       eureka    false    204                       1259    412229    sys_tipos_registros    TABLE     �   CREATE TABLE sys_tipos_registros (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    sys_status boolean NOT NULL,
    sys_fecha timestamp with time zone DEFAULT now()
);
 (   DROP TABLE activos.sys_tipos_registros;
       activos         eureka    false    7            =           0    0    TABLE sys_tipos_registros    COMMENT     i   COMMENT ON TABLE sys_tipos_registros IS 'Tabla que almacena todos los tipos de registros en el sistema';
            activos       eureka    false    263            >           0    0    COLUMN sys_tipos_registros.id    COMMENT     >   COMMENT ON COLUMN sys_tipos_registros.id IS 'Clave primaria';
            activos       eureka    false    263            ?           0    0 !   COLUMN sys_tipos_registros.nombre    COMMENT     G   COMMENT ON COLUMN sys_tipos_registros.nombre IS 'Nombre del registro';
            activos       eureka    false    263            @           0    0 %   COLUMN sys_tipos_registros.sys_status    COMMENT     S   COMMENT ON COLUMN sys_tipos_registros.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    263                       1259    412227    sys_tipos_registros_id_seq    SEQUENCE     |   CREATE SEQUENCE sys_tipos_registros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE activos.sys_tipos_registros_id_seq;
       activos       eureka    false    7    263            A           0    0    sys_tipos_registros_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE sys_tipos_registros_id_seq OWNED BY sys_tipos_registros.id;
            activos       eureka    false    262            �            1259    411777 	   vehiculos    TABLE     G  CREATE TABLE vehiculos (
    id integer NOT NULL,
    mueble_id integer NOT NULL,
    anho integer NOT NULL,
    uso integer NOT NULL,
    num_certificado character varying(255) NOT NULL,
    placa character varying(15) NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE activos.vehiculos;
       activos         eureka    false    7            B           0    0    TABLE vehiculos    COMMENT     F   COMMENT ON TABLE vehiculos IS 'Tabla que almacena un tipo de mueble';
            activos       eureka    false    219            C           0    0    COLUMN vehiculos.id    COMMENT     4   COMMENT ON COLUMN vehiculos.id IS 'Clave primaria';
            activos       eureka    false    219            D           0    0    COLUMN vehiculos.mueble_id    COMMENT     M   COMMENT ON COLUMN vehiculos.mueble_id IS 'Clave foranea a la tabla Muebles';
            activos       eureka    false    219            E           0    0    COLUMN vehiculos.anho    COMMENT     ,   COMMENT ON COLUMN vehiculos.anho IS 'Año';
            activos       eureka    false    219            F           0    0    COLUMN vehiculos.uso    COMMENT     K   COMMENT ON COLUMN vehiculos.uso IS 'Uso del vehiculo, expresado en meses';
            activos       eureka    false    219            G           0    0     COLUMN vehiculos.num_certificado    COMMENT     H   COMMENT ON COLUMN vehiculos.num_certificado IS 'Numero de certificado';
            activos       eureka    false    219            H           0    0    COLUMN vehiculos.placa    COMMENT     E   COMMENT ON COLUMN vehiculos.placa IS 'Numero de placa del vehiculo';
            activos       eureka    false    219            I           0    0    COLUMN vehiculos.sys_status    COMMENT     I   COMMENT ON COLUMN vehiculos.sys_status IS 'Estatus interno del sistema';
            activos       eureka    false    219            �            1259    411775    vehiculos_id_seq    SEQUENCE     r   CREATE SEQUENCE vehiculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE activos.vehiculos_id_seq;
       activos       eureka    false    219    7            J           0    0    vehiculos_id_seq    SEQUENCE OWNED BY     7   ALTER SEQUENCE vehiculos_id_seq OWNED BY vehiculos.id;
            activos       eureka    false    218            �            1259    411540    accionistas    TABLE     X  CREATE TABLE accionistas (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    natural_juridica_id integer NOT NULL,
    porcentaje_accionario numeric(38,2) NOT NULL,
    valor_compra numeric(38,6) NOT NULL,
    fecha date NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE public.accionistas;
       public         postgres    false    5            K           0    0    TABLE accionistas    COMMENT     `   COMMENT ON TABLE accionistas IS 'Tabla donde se almacenan los accionistas de las contratistas';
            public       postgres    false    195            L           0    0    COLUMN accionistas.id    COMMENT     6   COMMENT ON COLUMN accionistas.id IS 'Clave primaria';
            public       postgres    false    195            M           0    0 !   COLUMN accionistas.contratista_id    COMMENT     X   COMMENT ON COLUMN accionistas.contratista_id IS 'Clave foranea a la tabla contratista';
            public       postgres    false    195            N           0    0 &   COLUMN accionistas.natural_juridica_id    COMMENT     e   COMMENT ON COLUMN accionistas.natural_juridica_id IS 'Clave foranea a la tabla naturales_juridicos';
            public       postgres    false    195            O           0    0 (   COLUMN accionistas.porcentaje_accionario    COMMENT     i   COMMENT ON COLUMN accionistas.porcentaje_accionario IS 'Porcentaje de acciones que tiene el accionista';
            public       postgres    false    195            P           0    0    COLUMN accionistas.valor_compra    COMMENT     ]   COMMENT ON COLUMN accionistas.valor_compra IS 'Precio de la accion al momento de su compra';
            public       postgres    false    195            Q           0    0    COLUMN accionistas.fecha    COMMENT     T   COMMENT ON COLUMN accionistas.fecha IS 'Fecha del momento que se compro la accion';
            public       postgres    false    195            R           0    0    COLUMN accionistas.sys_status    COMMENT     K   COMMENT ON COLUMN accionistas.sys_status IS 'Estatus interno del sistema';
            public       postgres    false    195            �            1259    411538    accionistas_id_seq    SEQUENCE     t   CREATE SEQUENCE accionistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.accionistas_id_seq;
       public       postgres    false    5    195            S           0    0    accionistas_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE accionistas_id_seq OWNED BY accionistas.id;
            public       postgres    false    194            �            1259    411477    bancos_contratistas    TABLE     /  CREATE TABLE bancos_contratistas (
    id integer NOT NULL,
    banco_id integer NOT NULL,
    contratista_id integer NOT NULL,
    num_cuenta interval NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    nacional boolean DEFAULT true NOT NULL
);
 '   DROP TABLE public.bancos_contratistas;
       public         eureka    false    5            T           0    0    TABLE bancos_contratistas    COMMENT     q   COMMENT ON TABLE bancos_contratistas IS 'Tabla relacion donde se almacenan los bancos que tiene un contratista';
            public       eureka    false    187            U           0    0    COLUMN bancos_contratistas.id    COMMENT     >   COMMENT ON COLUMN bancos_contratistas.id IS 'Clave primaria';
            public       eureka    false    187            V           0    0 #   COLUMN bancos_contratistas.banco_id    COMMENT     U   COMMENT ON COLUMN bancos_contratistas.banco_id IS 'Clave foranea a la tabla bancos';
            public       eureka    false    187            W           0    0 )   COLUMN bancos_contratistas.contratista_id    COMMENT     ^   COMMENT ON COLUMN bancos_contratistas.contratista_id IS 'Clave foranea a tabla contratistas';
            public       eureka    false    187            X           0    0 %   COLUMN bancos_contratistas.num_cuenta    COMMENT     X   COMMENT ON COLUMN bancos_contratistas.num_cuenta IS 'Numero de cuenta del contratista';
            public       eureka    false    187            Y           0    0 %   COLUMN bancos_contratistas.sys_status    COMMENT     S   COMMENT ON COLUMN bancos_contratistas.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    187            Z           0    0 #   COLUMN bancos_contratistas.nacional    COMMENT     e   COMMENT ON COLUMN bancos_contratistas.nacional IS 'Si la cuenta pertenece a un banco nacional o no';
            public       eureka    false    187            �            1259    411475    bancos_contratistas_id_seq    SEQUENCE     |   CREATE SEQUENCE bancos_contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.bancos_contratistas_id_seq;
       public       eureka    false    187    5            [           0    0    bancos_contratistas_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE bancos_contratistas_id_seq OWNED BY bancos_contratistas.id;
            public       eureka    false    186            �            1259    411464    clientes    TABLE     0  CREATE TABLE clientes (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    publico boolean DEFAULT false,
    contratista_id integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    natural_juridico_id integer NOT NULL
);
    DROP TABLE public.clientes;
       public         eureka    false    5            \           0    0    COLUMN clientes.id    COMMENT     3   COMMENT ON COLUMN clientes.id IS 'Clave primaria';
            public       eureka    false    185            ]           0    0    COLUMN clientes.nombre    COMMENT     ;   COMMENT ON COLUMN clientes.nombre IS 'Nombre del cliente';
            public       eureka    false    185            ^           0    0    COLUMN clientes.publico    COMMENT     T   COMMENT ON COLUMN clientes.publico IS 'Si el cliente es un ente publico o privado';
            public       eureka    false    185            _           0    0    COLUMN clientes.contratista_id    COMMENT     U   COMMENT ON COLUMN clientes.contratista_id IS 'Relacion contra la tabla contratista';
            public       eureka    false    185            `           0    0    COLUMN clientes.sys_status    COMMENT     H   COMMENT ON COLUMN clientes.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    185            a           0    0 #   COLUMN clientes.natural_juridico_id    COMMENT     b   COMMENT ON COLUMN clientes.natural_juridico_id IS 'Clave foranea a la tabla Naturales_Juridicos';
            public       eureka    false    185            �            1259    411462    clientes_id_seq    SEQUENCE     q   CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.clientes_id_seq;
       public       eureka    false    5    185            b           0    0    clientes_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE clientes_id_seq OWNED BY clientes.id;
            public       eureka    false    184            �            1259    411502    contratistas    TABLE     �   CREATE TABLE contratistas (
    id integer NOT NULL,
    natural_juridica_id integer NOT NULL,
    estatus_contratista_id integer NOT NULL
);
     DROP TABLE public.contratistas;
       public         postgres    false    5            c           0    0    TABLE contratistas    COMMENT     w   COMMENT ON TABLE contratistas IS 'Tabla donde se almacenan todas las empresas que contratan con el estado Venezolano';
            public       postgres    false    191            d           0    0    COLUMN contratistas.id    COMMENT     7   COMMENT ON COLUMN contratistas.id IS 'Clave primaria';
            public       postgres    false    191            e           0    0 '   COLUMN contratistas.natural_juridica_id    COMMENT     e   COMMENT ON COLUMN contratistas.natural_juridica_id IS 'Clave foranea a la tabla naturales_juridica';
            public       postgres    false    191            f           0    0 *   COLUMN contratistas.estatus_contratista_id    COMMENT     i   COMMENT ON COLUMN contratistas.estatus_contratista_id IS 'Clave foranea a la tabla estatus_contratista';
            public       postgres    false    191            �            1259    411500    contratistas_id_seq    SEQUENCE     u   CREATE SEQUENCE contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.contratistas_id_seq;
       public       postgres    false    191    5            g           0    0    contratistas_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE contratistas_id_seq OWNED BY contratistas.id;
            public       postgres    false    190            �            1259    411441 
   directores    TABLE     �   CREATE TABLE directores (
    id integer NOT NULL,
    miembro_junta boolean DEFAULT false NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    persona_natural_id integer NOT NULL
);
    DROP TABLE public.directores;
       public         eureka    false    5            h           0    0    TABLE directores    COMMENT     =   COMMENT ON TABLE directores IS 'Directores de las empresas';
            public       eureka    false    181            i           0    0    COLUMN directores.id    COMMENT     5   COMMENT ON COLUMN directores.id IS 'Clave primaria';
            public       eureka    false    181            j           0    0    COLUMN directores.miembro_junta    COMMENT     d   COMMENT ON COLUMN directores.miembro_junta IS 'Si el director pertenece o no a la junta directiva';
            public       eureka    false    181            k           0    0    COLUMN directores.sys_status    COMMENT     J   COMMENT ON COLUMN directores.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    181            l           0    0 $   COLUMN directores.persona_natural_id    COMMENT     `   COMMENT ON COLUMN directores.persona_natural_id IS 'Clave foranea a la tabla personas_natural';
            public       eureka    false    181            �            1259    411439    directores_id_seq    SEQUENCE     s   CREATE SEQUENCE directores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.directores_id_seq;
       public       eureka    false    181    5            m           0    0    directores_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE directores_id_seq OWNED BY directores.id;
            public       eureka    false    180            �            1259    411520    empresas_relacionadas    TABLE     �   CREATE TABLE empresas_relacionadas (
    id integer NOT NULL,
    persona_juridica_id integer NOT NULL,
    contratista_id integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time without time zone DEFAULT now()
);
 )   DROP TABLE public.empresas_relacionadas;
       public         eureka    false    5            n           0    0    TABLE empresas_relacionadas    COMMENT     p   COMMENT ON TABLE empresas_relacionadas IS 'Tabla donde se guardan las empresas relacionadas de un contratista';
            public       eureka    false    193            o           0    0    COLUMN empresas_relacionadas.id    COMMENT     @   COMMENT ON COLUMN empresas_relacionadas.id IS 'Clave primaria';
            public       eureka    false    193            p           0    0 0   COLUMN empresas_relacionadas.persona_juridica_id    COMMENT     n   COMMENT ON COLUMN empresas_relacionadas.persona_juridica_id IS 'Clave foranea a la tabla personas_juridicas';
            public       eureka    false    193            q           0    0 +   COLUMN empresas_relacionadas.contratista_id    COMMENT     c   COMMENT ON COLUMN empresas_relacionadas.contratista_id IS 'Clave foranea a la tabla contratistas';
            public       eureka    false    193            r           0    0 '   COLUMN empresas_relacionadas.sys_status    COMMENT     U   COMMENT ON COLUMN empresas_relacionadas.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    193            �            1259    411518    empresas_relacionadas_id_seq    SEQUENCE     ~   CREATE SEQUENCE empresas_relacionadas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.empresas_relacionadas_id_seq;
       public       eureka    false    193    5            s           0    0    empresas_relacionadas_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE empresas_relacionadas_id_seq OWNED BY empresas_relacionadas.id;
            public       eureka    false    192            �            1259    411452    estatus_contratistas    TABLE     �   CREATE TABLE estatus_contratistas (
    id integer NOT NULL,
    descripcion text NOT NULL,
    informacion_adicional text,
    sys_status boolean NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
 (   DROP TABLE public.estatus_contratistas;
       public         eureka    false    5            t           0    0    COLUMN estatus_contratistas.id    COMMENT     ?   COMMENT ON COLUMN estatus_contratistas.id IS 'Clave primaria';
            public       eureka    false    183            u           0    0 '   COLUMN estatus_contratistas.descripcion    COMMENT     P   COMMENT ON COLUMN estatus_contratistas.descripcion IS 'Descripcion del estado';
            public       eureka    false    183            v           0    0 1   COLUMN estatus_contratistas.informacion_adicional    COMMENT     n   COMMENT ON COLUMN estatus_contratistas.informacion_adicional IS 'Informacion que complemente la descripcion';
            public       eureka    false    183            w           0    0 &   COLUMN estatus_contratistas.sys_status    COMMENT     S   COMMENT ON COLUMN estatus_contratistas.sys_status IS 'Estado interno del sistema';
            public       eureka    false    183            �            1259    411450    estatus_contratistas_id_seq    SEQUENCE     }   CREATE SEQUENCE estatus_contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.estatus_contratistas_id_seq;
       public       eureka    false    5    183            x           0    0    estatus_contratistas_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE estatus_contratistas_id_seq OWNED BY estatus_contratistas.id;
            public       eureka    false    182            �            1259    411384    sys_inpc    TABLE     �   CREATE TABLE sys_inpc (
    id integer NOT NULL,
    mes integer NOT NULL,
    indice numeric(38,6) NOT NULL,
    anho integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE public.sys_inpc;
       public         eureka    false    5            y           0    0    TABLE sys_inpc    COMMENT     H   COMMENT ON TABLE sys_inpc IS 'Indice nacional de precio al consumidor';
            public       eureka    false    173            z           0    0    COLUMN sys_inpc.id    COMMENT     3   COMMENT ON COLUMN sys_inpc.id IS 'Clave primaria';
            public       eureka    false    173            {           0    0    COLUMN sys_inpc.mes    COMMENT     2   COMMENT ON COLUMN sys_inpc.mes IS 'Mes del inpc';
            public       eureka    false    173            |           0    0    COLUMN sys_inpc.indice    COMMENT     @   COMMENT ON COLUMN sys_inpc.indice IS 'Valor del inpc del mes.';
            public       eureka    false    173            }           0    0    COLUMN sys_inpc.anho    COMMENT     <   COMMENT ON COLUMN sys_inpc.anho IS 'Año cargado del inpc';
            public       eureka    false    173            ~           0    0    COLUMN sys_inpc.sys_status    COMMENT     P   COMMENT ON COLUMN sys_inpc.sys_status IS 'Estatus de la columna: true o false';
            public       eureka    false    173            �            1259    411382    inpc_id_seq    SEQUENCE     m   CREATE SEQUENCE inpc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.inpc_id_seq;
       public       eureka    false    173    5                       0    0    inpc_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE inpc_id_seq OWNED BY sys_inpc.id;
            public       eureka    false    172                       1259    412264 	   migration    TABLE     `   CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);
    DROP TABLE public.migration;
       public         eureka    false    5            �            1259    411490    sys_naturales_juridicas    TABLE       CREATE TABLE sys_naturales_juridicas (
    id integer NOT NULL,
    rif character varying(20) NOT NULL,
    juridica boolean NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    denominacion character varying(255) NOT NULL
);
 +   DROP TABLE public.sys_naturales_juridicas;
       public         eureka    false    5            �           0    0    TABLE sys_naturales_juridicas    COMMENT     {   COMMENT ON TABLE sys_naturales_juridicas IS 'Almacena todos los rif de las personas naturales y juridicas en el sistema ';
            public       eureka    false    189            �           0    0 !   COLUMN sys_naturales_juridicas.id    COMMENT     B   COMMENT ON COLUMN sys_naturales_juridicas.id IS 'Clave primaria';
            public       eureka    false    189            �           0    0 "   COLUMN sys_naturales_juridicas.rif    COMMENT     R   COMMENT ON COLUMN sys_naturales_juridicas.rif IS 'Rgistro de informacion fiscal';
            public       eureka    false    189            �           0    0 '   COLUMN sys_naturales_juridicas.juridica    COMMENT     m   COMMENT ON COLUMN sys_naturales_juridicas.juridica IS 'Si el rif pertenece a una figura juridica o natural';
            public       eureka    false    189            �           0    0 )   COLUMN sys_naturales_juridicas.sys_status    COMMENT     W   COMMENT ON COLUMN sys_naturales_juridicas.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    189            �           0    0 +   COLUMN sys_naturales_juridicas.denominacion    COMMENT     �   COMMENT ON COLUMN sys_naturales_juridicas.denominacion IS 'Nombre de la persona juridica o la concatenacion del nombre y apellido de una persona natural.';
            public       eureka    false    189            �            1259    411488    naturales_juridicas_id_seq    SEQUENCE     |   CREATE SEQUENCE naturales_juridicas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.naturales_juridicas_id_seq;
       public       eureka    false    189    5            �           0    0    naturales_juridicas_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE naturales_juridicas_id_seq OWNED BY sys_naturales_juridicas.id;
            public       eureka    false    188            �            1259    411598    nombres_cajas    TABLE     �   CREATE TABLE nombres_cajas (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    contratistas_id integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone NOT NULL
);
 !   DROP TABLE public.nombres_cajas;
       public         eureka    false    5            �           0    0    TABLE nombres_cajas    COMMENT     U   COMMENT ON TABLE nombres_cajas IS 'Nombre de las cajas que tienen los contratistas';
            public       eureka    false    199            �           0    0    COLUMN nombres_cajas.id    COMMENT     8   COMMENT ON COLUMN nombres_cajas.id IS 'Clave primaria';
            public       eureka    false    199            �           0    0    COLUMN nombres_cajas.nombre    COMMENT     ?   COMMENT ON COLUMN nombres_cajas.nombre IS 'Nombre de la caja';
            public       eureka    false    199            �           0    0 $   COLUMN nombres_cajas.contratistas_id    COMMENT     \   COMMENT ON COLUMN nombres_cajas.contratistas_id IS 'Clave foranea a la tabla contratistas';
            public       eureka    false    199            �           0    0    COLUMN nombres_cajas.sys_status    COMMENT     M   COMMENT ON COLUMN nombres_cajas.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    199            �            1259    411596    nombres_cajas_id_seq    SEQUENCE     v   CREATE SEQUENCE nombres_cajas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.nombres_cajas_id_seq;
       public       eureka    false    199    5            �           0    0    nombres_cajas_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE nombres_cajas_id_seq OWNED BY nombres_cajas.id;
            public       eureka    false    198            �            1259    411630    notas_revelatorias    TABLE     $  CREATE TABLE notas_revelatorias (
    id integer NOT NULL,
    nota text NOT NULL,
    contratista_id integer NOT NULL,
    usuario_id integer NOT NULL,
    estado boolean DEFAULT true NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
 &   DROP TABLE public.notas_revelatorias;
       public         eureka    false    5            �           0    0    TABLE notas_revelatorias    COMMENT     k   COMMENT ON TABLE notas_revelatorias IS 'Tabla donde se alojan las notas revelatorias de los contratistas';
            public       eureka    false    203            �           0    0    COLUMN notas_revelatorias.id    COMMENT     <   COMMENT ON COLUMN notas_revelatorias.id IS 'Clave foranea';
            public       eureka    false    203            �           0    0    COLUMN notas_revelatorias.nota    COMMENT     f   COMMENT ON COLUMN notas_revelatorias.nota IS 'Nota creada por el usuario secundario del contratista';
            public       eureka    false    203            �           0    0 (   COLUMN notas_revelatorias.contratista_id    COMMENT     `   COMMENT ON COLUMN notas_revelatorias.contratista_id IS 'Clave foranea a la tabla contratistas';
            public       eureka    false    203            �           0    0 $   COLUMN notas_revelatorias.usuario_id    COMMENT     �   COMMENT ON COLUMN notas_revelatorias.usuario_id IS 'Clave foranea a la tabla de usuarios, haciendo referencia al usuario que creo la nota revelatoria';
            public       eureka    false    203            �           0    0     COLUMN notas_revelatorias.estado    COMMENT     N   COMMENT ON COLUMN notas_revelatorias.estado IS 'Si la nota esta activa o no';
            public       eureka    false    203            �           0    0 $   COLUMN notas_revelatorias.sys_status    COMMENT     R   COMMENT ON COLUMN notas_revelatorias.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    203            �            1259    411628    notas_revelatorias_id_seq    SEQUENCE     {   CREATE SEQUENCE notas_revelatorias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.notas_revelatorias_id_seq;
       public       eureka    false    203    5            �           0    0    notas_revelatorias_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE notas_revelatorias_id_seq OWNED BY notas_revelatorias.id;
            public       eureka    false    202            �            1259    411429    personas_juridicas    TABLE       CREATE TABLE personas_juridicas (
    id integer NOT NULL,
    rif character varying(20) NOT NULL,
    razon_social character varying(255),
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    creado_por integer NOT NULL
);
 &   DROP TABLE public.personas_juridicas;
       public         eureka    false    5            �           0    0    TABLE personas_juridicas    COMMENT     e   COMMENT ON TABLE personas_juridicas IS 'Tabla para almacenar toda la figura juridica en el sistema';
            public       eureka    false    179            �           0    0    COLUMN personas_juridicas.id    COMMENT     =   COMMENT ON COLUMN personas_juridicas.id IS 'Clave primaria';
            public       eureka    false    179            �           0    0    COLUMN personas_juridicas.rif    COMMENT     N   COMMENT ON COLUMN personas_juridicas.rif IS 'Registro de informacion fiscal';
            public       eureka    false    179            �           0    0 &   COLUMN personas_juridicas.razon_social    COMMENT     V   COMMENT ON COLUMN personas_juridicas.razon_social IS 'Nombre e la empresa registada';
            public       eureka    false    179            �           0    0 $   COLUMN personas_juridicas.sys_status    COMMENT     R   COMMENT ON COLUMN personas_juridicas.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    179            �           0    0 $   COLUMN personas_juridicas.creado_por    COMMENT     q   COMMENT ON COLUMN personas_juridicas.creado_por IS 'Mantiene la referencia al usuario que realizo la insercion';
            public       eureka    false    179            �            1259    411427    personas_juridicas_id_seq    SEQUENCE     {   CREATE SEQUENCE personas_juridicas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.personas_juridicas_id_seq;
       public       eureka    false    179    5            �           0    0    personas_juridicas_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE personas_juridicas_id_seq OWNED BY personas_juridicas.id;
            public       eureka    false    178            �            1259    411412    personas_naturales    TABLE     X  CREATE TABLE personas_naturales (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    apellido character varying(255) NOT NULL,
    rif character varying(20) NOT NULL,
    ci integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now(),
    creado_por integer NOT NULL
);
 &   DROP TABLE public.personas_naturales;
       public         eureka    false    5            �           0    0    TABLE personas_naturales    COMMENT     X   COMMENT ON TABLE personas_naturales IS 'Personas naturales registradas en el sistema.';
            public       eureka    false    177            �           0    0    COLUMN personas_naturales.id    COMMENT     =   COMMENT ON COLUMN personas_naturales.id IS 'Clave primaria';
            public       eureka    false    177            �           0    0     COLUMN personas_naturales.nombre    COMMENT     Z   COMMENT ON COLUMN personas_naturales.nombre IS 'Nombre de la persona natural registrada';
            public       eureka    false    177            �           0    0 "   COLUMN personas_naturales.apellido    COMMENT     ^   COMMENT ON COLUMN personas_naturales.apellido IS 'Apellido de la persona natural registrada';
            public       eureka    false    177            �           0    0    COLUMN personas_naturales.rif    COMMENT     T   COMMENT ON COLUMN personas_naturales.rif IS 'Rif de la persona natural registrada';
            public       eureka    false    177            �           0    0    COLUMN personas_naturales.ci    COMMENT     [   COMMENT ON COLUMN personas_naturales.ci IS 'Cedula de identidad de la persona registrada';
            public       eureka    false    177            �           0    0 $   COLUMN personas_naturales.sys_status    COMMENT     R   COMMENT ON COLUMN personas_naturales.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    177            �           0    0 $   COLUMN personas_naturales.creado_por    COMMENT     q   COMMENT ON COLUMN personas_naturales.creado_por IS 'Mantiene la referencia al usuario que realizo la insercion';
            public       eureka    false    177            �            1259    411410    personas_naturales_id_seq    SEQUENCE     {   CREATE SEQUENCE personas_naturales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.personas_naturales_id_seq;
       public       eureka    false    5    177            �           0    0    personas_naturales_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE personas_naturales_id_seq OWNED BY personas_naturales.id;
            public       eureka    false    176            �            1259    411560    repr_legales    TABLE     �   CREATE TABLE repr_legales (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    persona_natural_id integer NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
     DROP TABLE public.repr_legales;
       public         eureka    false    5            �           0    0    TABLE repr_legales    COMMENT     ;   COMMENT ON TABLE repr_legales IS 'Representantes legales';
            public       eureka    false    197            �           0    0    COLUMN repr_legales.id    COMMENT     7   COMMENT ON COLUMN repr_legales.id IS 'Clave primaria';
            public       eureka    false    197            �           0    0 "   COLUMN repr_legales.contratista_id    COMMENT     Z   COMMENT ON COLUMN repr_legales.contratista_id IS 'Clave foranea a la tabla contratistas';
            public       eureka    false    197            �           0    0 &   COLUMN repr_legales.persona_natural_id    COMMENT     d   COMMENT ON COLUMN repr_legales.persona_natural_id IS 'Clave foranea a la tabla personas naturales';
            public       eureka    false    197            �           0    0    COLUMN repr_legales.sys_status    COMMENT     L   COMMENT ON COLUMN repr_legales.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    197            �            1259    411558    repr_legales_id_seq    SEQUENCE     u   CREATE SEQUENCE repr_legales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.repr_legales_id_seq;
       public       eureka    false    5    197            �           0    0    repr_legales_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE repr_legales_id_seq OWNED BY repr_legales.id;
            public       eureka    false    196            �            1259    411396 
   sys_bancos    TABLE       CREATE TABLE sys_bancos (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    rif character varying(25) NOT NULL,
    codigo_sudeban character varying(10) NOT NULL,
    sys_status boolean DEFAULT true NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE public.sys_bancos;
       public         eureka    false    5            �           0    0    TABLE sys_bancos    COMMENT     R   COMMENT ON TABLE sys_bancos IS 'Tabla que almacena todos los bancos del sistema';
            public       eureka    false    175            �           0    0    COLUMN sys_bancos.id    COMMENT     5   COMMENT ON COLUMN sys_bancos.id IS 'Clave primaria';
            public       eureka    false    175            �           0    0    COLUMN sys_bancos.nombre    COMMENT     ;   COMMENT ON COLUMN sys_bancos.nombre IS 'Nombre del banco';
            public       eureka    false    175            �           0    0    COLUMN sys_bancos.rif    COMMENT     5   COMMENT ON COLUMN sys_bancos.rif IS 'Rif del banco';
            public       eureka    false    175            �           0    0     COLUMN sys_bancos.codigo_sudeban    COMMENT     R   COMMENT ON COLUMN sys_bancos.codigo_sudeban IS 'Identificado numerico del banco';
            public       eureka    false    175            �           0    0    COLUMN sys_bancos.sys_status    COMMENT     J   COMMENT ON COLUMN sys_bancos.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    175            �            1259    411394    sys_bancos_id_seq    SEQUENCE     s   CREATE SEQUENCE sys_bancos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.sys_bancos_id_seq;
       public       eureka    false    5    175            �           0    0    sys_bancos_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE sys_bancos_id_seq OWNED BY sys_bancos.id;
            public       eureka    false    174            �            1259    411614    sys_divisas    TABLE     �   CREATE TABLE sys_divisas (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    codigo character varying(20) NOT NULL,
    sys_status boolean NOT NULL,
    sys_fecha time with time zone DEFAULT now()
);
    DROP TABLE public.sys_divisas;
       public         eureka    false    5            �           0    0    TABLE sys_divisas    COMMENT     l   COMMENT ON TABLE sys_divisas IS 'Tabla donde se alojan todos los posibles tipos de divisas y sus cambios.';
            public       eureka    false    201            �           0    0    COLUMN sys_divisas.id    COMMENT     5   COMMENT ON COLUMN sys_divisas.id IS 'Clave foranea';
            public       eureka    false    201            �           0    0    COLUMN sys_divisas.nombre    COMMENT     ?   COMMENT ON COLUMN sys_divisas.nombre IS 'Nombre de la moneda';
            public       eureka    false    201            �           0    0    COLUMN sys_divisas.codigo    COMMENT     E   COMMENT ON COLUMN sys_divisas.codigo IS 'Abreviacion de la moneda.';
            public       eureka    false    201            �           0    0    COLUMN sys_divisas.sys_status    COMMENT     L   COMMENT ON COLUMN sys_divisas.sys_status IS 'Estatus interno del sistema.';
            public       eureka    false    201            �            1259    411612    sys_monedas_id_seq    SEQUENCE     t   CREATE SEQUENCE sys_monedas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.sys_monedas_id_seq;
       public       eureka    false    201    5            �           0    0    sys_monedas_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE sys_monedas_id_seq OWNED BY sys_divisas.id;
            public       eureka    false    200            �            1259    412089    sys_tasas_divisas    TABLE     �   CREATE TABLE sys_tasas_divisas (
    id integer NOT NULL,
    sys_divisa_id integer NOT NULL,
    tasa numeric(38,6) NOT NULL,
    sys_status boolean DEFAULT true,
    sys_fecha timestamp with time zone DEFAULT now()
);
 %   DROP TABLE public.sys_tasas_divisas;
       public         eureka    false    5            �           0    0    TABLE sys_tasas_divisas    COMMENT     j   COMMENT ON TABLE sys_tasas_divisas IS 'Tabla que almacena todos los historicos de cambios de una divisa';
            public       eureka    false    249            �           0    0    COLUMN sys_tasas_divisas.id    COMMENT     <   COMMENT ON COLUMN sys_tasas_divisas.id IS 'Clave primaria';
            public       eureka    false    249            �           0    0 &   COLUMN sys_tasas_divisas.sys_divisa_id    COMMENT     _   COMMENT ON COLUMN sys_tasas_divisas.sys_divisa_id IS 'Clave foranea a la tabla Sys_Divisa_id';
            public       eureka    false    249            �           0    0    COLUMN sys_tasas_divisas.tasa    COMMENT     B   COMMENT ON COLUMN sys_tasas_divisas.tasa IS 'Costo de la divisa';
            public       eureka    false    249            �           0    0 #   COLUMN sys_tasas_divisas.sys_status    COMMENT     Q   COMMENT ON COLUMN sys_tasas_divisas.sys_status IS 'Estatus interno del sistema';
            public       eureka    false    249            �            1259    412087    sys_tasas_divisas_id_seq    SEQUENCE     z   CREATE SEQUENCE sys_tasas_divisas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.sys_tasas_divisas_id_seq;
       public       eureka    false    5    249            �           0    0    sys_tasas_divisas_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE sys_tasas_divisas_id_seq OWNED BY sys_tasas_divisas.id;
            public       eureka    false    248            
           1259    412271    user    TABLE     �  CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32) NOT NULL,
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255) NOT NULL,
    status smallint DEFAULT 10 NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);
    DROP TABLE public."user";
       public         eureka    false    5            	           1259    412269    user_id_seq    SEQUENCE     m   CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public       eureka    false    5    266            �           0    0    user_id_seq    SEQUENCE OWNED BY     /   ALTER SEQUENCE user_id_seq OWNED BY "user".id;
            public       eureka    false    265            �           2604    411795    id    DEFAULT     p   ALTER TABLE ONLY activos_biologicos ALTER COLUMN id SET DEFAULT nextval('activos_biologicos_id_seq'::regclass);
 E   ALTER TABLE activos.activos_biologicos ALTER COLUMN id DROP DEFAULT;
       activos       postgres    false    220    221    221            �           2604    411815    id    DEFAULT     r   ALTER TABLE ONLY activos_intangibles ALTER COLUMN id SET DEFAULT nextval('activos_intangibles_id_seq'::regclass);
 F   ALTER TABLE activos.activos_intangibles ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    223    222    223            �           2604    411916    id    DEFAULT     Z   ALTER TABLE ONLY avaluos ALTER COLUMN id SET DEFAULT nextval('avaluos_id_seq'::regclass);
 :   ALTER TABLE activos.avaluos ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    233    232    233            �           2604    411701    id    DEFAULT     X   ALTER TABLE ONLY bienes ALTER COLUMN id SET DEFAULT nextval('bienes_id_seq'::regclass);
 9   ALTER TABLE activos.bienes ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    211    210    211            �           2604    412196    id    DEFAULT     |   ALTER TABLE ONLY construcciones_inmuebles ALTER COLUMN id SET DEFAULT nextval('construcciones_inmuebles_id_seq'::regclass);
 K   ALTER TABLE activos.construcciones_inmuebles ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    258    259    259            �           2604    411724    id    DEFAULT     n   ALTER TABLE ONLY datos_importacion ALTER COLUMN id SET DEFAULT nextval('datos_importacion_id_seq'::regclass);
 D   ALTER TABLE activos.datos_importacion ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    213    212    213            �           2604    411941    id    DEFAULT     �   ALTER TABLE ONLY depresiaciones_amortizaciones ALTER COLUMN id SET DEFAULT nextval('depresiaciones_amortizaciones_id_seq'::regclass);
 P   ALTER TABLE activos.depresiaciones_amortizaciones ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    234    235    235            �           2604    412038    id    DEFAULT     |   ALTER TABLE ONLY desincorporacion_activos ALTER COLUMN id SET DEFAULT nextval('desincorporacion_activos_id_seq'::regclass);
 K   ALTER TABLE activos.desincorporacion_activos ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    245    244    245            �           2604    412008    id    DEFAULT     `   ALTER TABLE ONLY deterioros ALTER COLUMN id SET DEFAULT nextval('deterioros_id_seq'::regclass);
 =   ALTER TABLE activos.deterioros ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    240    241    241            �           2604    411875    id    DEFAULT     x   ALTER TABLE ONLY documentos_registrados ALTER COLUMN id SET DEFAULT nextval('documentos_registrados_id_seq'::regclass);
 I   ALTER TABLE activos.documentos_registrados ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    229    228    229            �           2604    412211    id    DEFAULT     v   ALTER TABLE ONLY fabricaciones_muebles ALTER COLUMN id SET DEFAULT nextval('fabricaciones_muebles_id_seq'::regclass);
 H   ALTER TABLE activos.fabricaciones_muebles ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    260    261    261            �           2604    411845    id    DEFAULT     \   ALTER TABLE ONLY facturas ALTER COLUMN id SET DEFAULT nextval('facturas_id_seq'::regclass);
 ;   ALTER TABLE activos.facturas ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    227    226    227            �           2604    411744    id    DEFAULT     ^   ALTER TABLE ONLY inmuebles ALTER COLUMN id SET DEFAULT nextval('inmuebles_id_seq'::regclass);
 <   ALTER TABLE activos.inmuebles ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    214    215    215            �           2604    411830    id    DEFAULT     \   ALTER TABLE ONLY licencia ALTER COLUMN id SET DEFAULT nextval('licencia_id_seq'::regclass);
 ;   ALTER TABLE activos.licencia ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    224    225    225            �           2604    411971    id    DEFAULT     \   ALTER TABLE ONLY medicion ALTER COLUMN id SET DEFAULT nextval('medicion_id_seq'::regclass);
 ;   ALTER TABLE activos.medicion ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    239    238    239            �           2604    412053    id    DEFAULT     p   ALTER TABLE ONLY mejoras_propiedades ALTER COLUMN id SET DEFAULT nextval('mejoras_propiedad_id_seq'::regclass);
 F   ALTER TABLE activos.mejoras_propiedades ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    246    247    247            �           2604    411762    id    DEFAULT     Z   ALTER TABLE ONLY muebles ALTER COLUMN id SET DEFAULT nextval('muebles_id_seq'::regclass);
 :   ALTER TABLE activos.muebles ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    216    217    217            �           2604    412170    id    DEFAULT     d   ALTER TABLE ONLY sys_ciudades ALTER COLUMN id SET DEFAULT nextval('sys_ciudades_id_seq'::regclass);
 ?   ALTER TABLE activos.sys_ciudades ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    257    256    257            �           2604    412109    id    DEFAULT     ~   ALTER TABLE ONLY sys_clasificaciones_bienes ALTER COLUMN id SET DEFAULT nextval('sys_clasificaciones_bien_id_seq'::regclass);
 M   ALTER TABLE activos.sys_clasificaciones_bienes ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    251    250    251            �           2604    412155    id    DEFAULT     b   ALTER TABLE ONLY sys_estados ALTER COLUMN id SET DEFAULT nextval('sys_estados_id_seq'::regclass);
 >   ALTER TABLE activos.sys_estados ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    254    255    255                       2604    411686    id    DEFAULT     h   ALTER TABLE ONLY sys_formas_org ALTER COLUMN id SET DEFAULT nextval('sys_formas_org_id_seq'::regclass);
 A   ALTER TABLE activos.sys_formas_org ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    208    209    209            �           2604    411898    id    DEFAULT     b   ALTER TABLE ONLY sys_gremios ALTER COLUMN id SET DEFAULT nextval('sys_gremios_id_seq'::regclass);
 >   ALTER TABLE activos.sys_gremios ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    231    230    231            �           2604    411956    id    DEFAULT     r   ALTER TABLE ONLY sys_metodo_medicion ALTER COLUMN id SET DEFAULT nextval('sys_metodo_medicion_id_seq'::regclass);
 F   ALTER TABLE activos.sys_metodo_medicion ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    236    237    237            �           2604    412023    id    DEFAULT     d   ALTER TABLE ONLY sys_motivios ALTER COLUMN id SET DEFAULT nextval('sys_motivios_id_seq'::regclass);
 ?   ALTER TABLE activos.sys_motivios ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    243    242    243            �           2604    412143    id    DEFAULT     `   ALTER TABLE ONLY sys_paises ALTER COLUMN id SET DEFAULT nextval('sys_paises_id_seq'::regclass);
 =   ALTER TABLE activos.sys_paises ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    252    253    253            |           2604    411672    id    DEFAULT     i   ALTER TABLE ONLY sys_tipos_bienes ALTER COLUMN id SET DEFAULT nextval('sys_tipo_bien_id_seq'::regclass);
 C   ALTER TABLE activos.sys_tipos_bienes ALTER COLUMN id DROP DEFAULT;
       activos       postgres    false    206    207    207            x           2604    411658    id    DEFAULT     r   ALTER TABLE ONLY sys_tipos_documentos ALTER COLUMN id SET DEFAULT nextval('sys_tipo_documento_id_seq'::regclass);
 G   ALTER TABLE activos.sys_tipos_documentos ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    205    204    205            �           2604    412232    id    DEFAULT     r   ALTER TABLE ONLY sys_tipos_registros ALTER COLUMN id SET DEFAULT nextval('sys_tipos_registros_id_seq'::regclass);
 F   ALTER TABLE activos.sys_tipos_registros ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    262    263    263            �           2604    411780    id    DEFAULT     ^   ALTER TABLE ONLY vehiculos ALTER COLUMN id SET DEFAULT nextval('vehiculos_id_seq'::regclass);
 <   ALTER TABLE activos.vehiculos ALTER COLUMN id DROP DEFAULT;
       activos       eureka    false    218    219    219            j           2604    411543    id    DEFAULT     b   ALTER TABLE ONLY accionistas ALTER COLUMN id SET DEFAULT nextval('accionistas_id_seq'::regclass);
 =   ALTER TABLE public.accionistas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    195    194    195            _           2604    411480    id    DEFAULT     r   ALTER TABLE ONLY bancos_contratistas ALTER COLUMN id SET DEFAULT nextval('bancos_contratistas_id_seq'::regclass);
 E   ALTER TABLE public.bancos_contratistas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    187    186    187            [           2604    411467    id    DEFAULT     \   ALTER TABLE ONLY clientes ALTER COLUMN id SET DEFAULT nextval('clientes_id_seq'::regclass);
 :   ALTER TABLE public.clientes ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    184    185    185            f           2604    411505    id    DEFAULT     d   ALTER TABLE ONLY contratistas ALTER COLUMN id SET DEFAULT nextval('contratistas_id_seq'::regclass);
 >   ALTER TABLE public.contratistas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    191    190    191            U           2604    411444    id    DEFAULT     `   ALTER TABLE ONLY directores ALTER COLUMN id SET DEFAULT nextval('directores_id_seq'::regclass);
 <   ALTER TABLE public.directores ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    181    180    181            g           2604    411523    id    DEFAULT     v   ALTER TABLE ONLY empresas_relacionadas ALTER COLUMN id SET DEFAULT nextval('empresas_relacionadas_id_seq'::regclass);
 G   ALTER TABLE public.empresas_relacionadas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    192    193    193            Y           2604    411455    id    DEFAULT     t   ALTER TABLE ONLY estatus_contratistas ALTER COLUMN id SET DEFAULT nextval('estatus_contratistas_id_seq'::regclass);
 F   ALTER TABLE public.estatus_contratistas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    182    183    183            p           2604    411601    id    DEFAULT     f   ALTER TABLE ONLY nombres_cajas ALTER COLUMN id SET DEFAULT nextval('nombres_cajas_id_seq'::regclass);
 ?   ALTER TABLE public.nombres_cajas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    198    199    199            v           2604    411633    id    DEFAULT     p   ALTER TABLE ONLY notas_revelatorias ALTER COLUMN id SET DEFAULT nextval('notas_revelatorias_id_seq'::regclass);
 D   ALTER TABLE public.notas_revelatorias ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    203    202    203            R           2604    411432    id    DEFAULT     p   ALTER TABLE ONLY personas_juridicas ALTER COLUMN id SET DEFAULT nextval('personas_juridicas_id_seq'::regclass);
 D   ALTER TABLE public.personas_juridicas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    178    179    179            O           2604    411415    id    DEFAULT     p   ALTER TABLE ONLY personas_naturales ALTER COLUMN id SET DEFAULT nextval('personas_naturales_id_seq'::regclass);
 D   ALTER TABLE public.personas_naturales ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    177    176    177            m           2604    411563    id    DEFAULT     d   ALTER TABLE ONLY repr_legales ALTER COLUMN id SET DEFAULT nextval('repr_legales_id_seq'::regclass);
 >   ALTER TABLE public.repr_legales ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    196    197    197            L           2604    411399    id    DEFAULT     `   ALTER TABLE ONLY sys_bancos ALTER COLUMN id SET DEFAULT nextval('sys_bancos_id_seq'::regclass);
 <   ALTER TABLE public.sys_bancos ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    175    174    175            r           2604    411617    id    DEFAULT     b   ALTER TABLE ONLY sys_divisas ALTER COLUMN id SET DEFAULT nextval('sys_monedas_id_seq'::regclass);
 =   ALTER TABLE public.sys_divisas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    200    201    201            I           2604    411387    id    DEFAULT     X   ALTER TABLE ONLY sys_inpc ALTER COLUMN id SET DEFAULT nextval('inpc_id_seq'::regclass);
 :   ALTER TABLE public.sys_inpc ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    172    173    173            c           2604    411493    id    DEFAULT     v   ALTER TABLE ONLY sys_naturales_juridicas ALTER COLUMN id SET DEFAULT nextval('naturales_juridicas_id_seq'::regclass);
 I   ALTER TABLE public.sys_naturales_juridicas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    189    188    189            �           2604    412092    id    DEFAULT     n   ALTER TABLE ONLY sys_tasas_divisas ALTER COLUMN id SET DEFAULT nextval('sys_tasas_divisas_id_seq'::regclass);
 C   ALTER TABLE public.sys_tasas_divisas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    248    249    249            �           2604    412274    id    DEFAULT     V   ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    265    266    266            >
          0    411792    activos_biologicos 
   TABLE DATA               z   COPY activos_biologicos (id, bien_id, catidad, certificado, num_certificado, detalles, sys_status, sys_fecha) FROM stdin;
    activos       postgres    false    221   �      �           0    0    activos_biologicos_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('activos_biologicos_id_seq', 1, false);
            activos       postgres    false    220            @
          0    411812    activos_intangibles 
   TABLE DATA               z   COPY activos_intangibles (id, bien_id, certificado_registro, fecha_registro, vigencia, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    223         �           0    0    activos_intangibles_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('activos_intangibles_id_seq', 1, false);
            activos       eureka    false    222            J
          0    411913    avaluos 
   TABLE DATA               �   COPY avaluos (id, bien_id, valor, fecha_informe, perito_id, gremio_id, num_inscripcion_gremio, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    233   8      �           0    0    avaluos_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('avaluos_id_seq', 1, false);
            activos       eureka    false    232            4
          0    411698    bienes 
   TABLE DATA               �   COPY bienes (id, sys_tipo_bien_id, principio_contable, depreciable, deterioro, detalle, origen, fecha_origen, contratista_id, propio) FROM stdin;
    activos       eureka    false    211   U      �           0    0    bienes_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('bienes_id_seq', 1, false);
            activos       eureka    false    210            d
          0    412193    construcciones_inmuebles 
   TABLE DATA               �   COPY construcciones_inmuebles (id, bien_id, area_construccion, porcentaje_ejecucion, monto_ejecutado, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    259   r      �           0    0    construcciones_inmuebles_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('construcciones_inmuebles_id_seq', 1, false);
            activos       eureka    false    258            6
          0    411721    datos_importacion 
   TABLE DATA               �   COPY datos_importacion (id, bien_id, num_guia_nac, costo_adquisicion, gastos_mon_extranjera, sys_moneda_id, tasa_cambio, gastos_imp_nacional, otros_costros_imp_instalacion, total_costo_adquisicion, sys_status, sys_fecha, pais_origen_id) FROM stdin;
    activos       eureka    false    213   �      �           0    0    datos_importacion_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('datos_importacion_id_seq', 1, false);
            activos       eureka    false    212            L
          0    411938    depresiaciones_amortizaciones 
   TABLE DATA                 COPY depresiaciones_amortizaciones (id, bien_id, costo_adquisicion_avaluo, fecha_adquisicion_avaluo, vida_util, valor_residual, valor_depreciar, tasa_anual, unidades_estimadas, bs_unidad, unidades_producidas_periodo, unidades_consumidas, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    235   �      �           0    0 $   depresiaciones_amortizaciones_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('depresiaciones_amortizaciones_id_seq', 1, false);
            activos       eureka    false    234            V
          0    412035    desincorporacion_activos 
   TABLE DATA               |   COPY desincorporacion_activos (id, sys_motivo_id, fecha, precio_venta, valor_neto_libro, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    245   �      �           0    0    desincorporacion_activos_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('desincorporacion_activos_id_seq', 1, false);
            activos       eureka    false    244            R
          0    412005 
   deterioros 
   TABLE DATA               �   COPY deterioros (id, bien_id, valor_razonable, costo_disposicion, valor_uso, acumulado_ejer_ant, ejercicios_anteriores, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    241   �      �           0    0    deterioros_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('deterioros_id_seq', 1, false);
            activos       eureka    false    240            F
          0    411872    documentos_registrados 
   TABLE DATA               �   COPY documentos_registrados (id, contratista_id, sys_tipo_documento_id, sys_tipo_registro_id, circunscripcion, num_registro_notaria, tomo, folio, fecha_registro, valor_adquisicion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    229         �           0    0    documentos_registrados_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('documentos_registrados_id_seq', 1, false);
            activos       eureka    false    228            f
          0    412208    fabricaciones_muebles 
   TABLE DATA                  COPY fabricaciones_muebles (id, bien_id, cantidad, porcentaje_fabricacion, monto_ejecutado, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    261          �           0    0    fabricaciones_muebles_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('fabricaciones_muebles_id_seq', 1, false);
            activos       eureka    false    260            D
          0    411842    facturas 
   TABLE DATA               �   COPY facturas (id, num_factura, proveedor_id, fecha_emision, imprenta_id, fecha_emision_talonario, comprador_id, base_imponible_gravable, execto, iva, contratista_id, bien_id) FROM stdin;
    activos       eureka    false    227   =      �           0    0    facturas_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('facturas_id_seq', 1, false);
            activos       eureka    false    226            8
          0    411741 	   inmuebles 
   TABLE DATA               �   COPY inmuebles (id, bien_id, descripcion, direccion_ubicacion, ficha_catastral, zonificacion, extension, titulo_supletorio, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    215   Z      �           0    0    inmuebles_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('inmuebles_id_seq', 1, false);
            activos       eureka    false    214            B
          0    411827    licencia 
   TABLE DATA               g   COPY licencia (id, activo_intangible_id, numero, fecha_adquisicion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    225   w      �           0    0    licencia_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('licencia_id_seq', 1, false);
            activos       eureka    false    224            P
          0    411968    medicion 
   TABLE DATA               �   COPY medicion (id, bien_id, medicion_activo, sys_metodo_medicion_id, sys_status, sys_fecha, aplica_deterioro, vinculado_proceso_productivo, vinculado_proceso_ventas) FROM stdin;
    activos       eureka    false    239   �      �           0    0    medicion_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('medicion_id_seq', 1, false);
            activos       eureka    false    238            �           0    0    mejoras_propiedad_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('mejoras_propiedad_id_seq', 1, false);
            activos       eureka    false    246            X
          0    412050    mejoras_propiedades 
   TABLE DATA               �   COPY mejoras_propiedades (id, clasificacion, sys_tipo_bien_id, principio_contable_id, depreciacion, deterioro, sys_status, sys_fecha, bien_id, monto, fecha, capitalizable) FROM stdin;
    activos       eureka    false    247   �      :
          0    411759    muebles 
   TABLE DATA               ^   COPY muebles (id, bien_id, marca, modelo, serial, cantiad, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    217   �      �           0    0    muebles_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('muebles_id_seq', 1, false);
            activos       eureka    false    216            b
          0    412167    sys_ciudades 
   TABLE DATA               `   COPY sys_ciudades (id, sys_estado_id, nombre, codigo_postal, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    257   �      �           0    0    sys_ciudades_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('sys_ciudades_id_seq', 1, false);
            activos       eureka    false    256            �           0    0    sys_clasificaciones_bien_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('sys_clasificaciones_bien_id_seq', 3, true);
            activos       eureka    false    250            \
          0    412106    sys_clasificaciones_bienes 
   TABLE DATA               ]   COPY sys_clasificaciones_bienes (id, nombre, descripcion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    251         `
          0    412152    sys_estados 
   TABLE DATA               N   COPY sys_estados (id, sys_pais_id, nombre, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    255   U      �           0    0    sys_estados_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('sys_estados_id_seq', 1, false);
            activos       eureka    false    254            2
          0    411683    sys_formas_org 
   TABLE DATA               Q   COPY sys_formas_org (id, nombre, descripcion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    209   r      �           0    0    sys_formas_org_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('sys_formas_org_id_seq', 3, true);
            activos       eureka    false    208            H
          0    411895    sys_gremios 
   TABLE DATA               Y   COPY sys_gremios (id, persona_juridica_id, direccion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    231   �      �           0    0    sys_gremios_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('sys_gremios_id_seq', 1, true);
            activos       eureka    false    230            N
          0    411953    sys_metodo_medicion 
   TABLE DATA               V   COPY sys_metodo_medicion (id, nombre, descripcion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    237         �           0    0    sys_metodo_medicion_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('sys_metodo_medicion_id_seq', 1, false);
            activos       eureka    false    236            T
          0    412020    sys_motivios 
   TABLE DATA               O   COPY sys_motivios (id, nombre, descripcion, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    243   <      �           0    0    sys_motivios_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('sys_motivios_id_seq', 1, false);
            activos       eureka    false    242            ^
          0    412140 
   sys_paises 
   TABLE DATA               @   COPY sys_paises (id, nombre, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    253   Y      �           0    0    sys_paises_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('sys_paises_id_seq', 1, true);
            activos       eureka    false    252            �           0    0    sys_tipo_bien_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('sys_tipo_bien_id_seq', 2, true);
            activos       postgres    false    206            �           0    0    sys_tipo_documento_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('sys_tipo_documento_id_seq', 1, false);
            activos       eureka    false    204            0
          0    411669    sys_tipos_bienes 
   TABLE DATA               n   COPY sys_tipos_bienes (id, nombre, sys_status, sys_fecha, descripcion, sys_clasificacion_bien_id) FROM stdin;
    activos       postgres    false    207   v      .
          0    411655    sys_tipos_documentos 
   TABLE DATA               R   COPY sys_tipos_documentos (id, nombre, estado, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    205   �      h
          0    412229    sys_tipos_registros 
   TABLE DATA               I   COPY sys_tipos_registros (id, nombre, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    263   �      �           0    0    sys_tipos_registros_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('sys_tipos_registros_id_seq', 1, false);
            activos       eureka    false    262            <
          0    411777 	   vehiculos 
   TABLE DATA               e   COPY vehiculos (id, mueble_id, anho, uso, num_certificado, placa, sys_status, sys_fecha) FROM stdin;
    activos       eureka    false    219   �      �           0    0    vehiculos_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('vehiculos_id_seq', 1, false);
            activos       eureka    false    218            $
          0    411540    accionistas 
   TABLE DATA               �   COPY accionistas (id, contratista_id, natural_juridica_id, porcentaje_accionario, valor_compra, fecha, sys_status, sys_fecha) FROM stdin;
    public       postgres    false    195         �           0    0    accionistas_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('accionistas_id_seq', 1, false);
            public       postgres    false    194            
          0    411477    bancos_contratistas 
   TABLE DATA               q   COPY bancos_contratistas (id, banco_id, contratista_id, num_cuenta, sys_status, sys_fecha, nacional) FROM stdin;
    public       eureka    false    187   )      �           0    0    bancos_contratistas_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('bancos_contratistas_id_seq', 1, false);
            public       eureka    false    186            
          0    411464    clientes 
   TABLE DATA               l   COPY clientes (id, nombre, publico, contratista_id, sys_status, sys_fecha, natural_juridico_id) FROM stdin;
    public       eureka    false    185   F      �           0    0    clientes_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('clientes_id_seq', 1, false);
            public       eureka    false    184             
          0    411502    contratistas 
   TABLE DATA               P   COPY contratistas (id, natural_juridica_id, estatus_contratista_id) FROM stdin;
    public       postgres    false    191   c      �           0    0    contratistas_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('contratistas_id_seq', 1, false);
            public       postgres    false    190            
          0    411441 
   directores 
   TABLE DATA               [   COPY directores (id, miembro_junta, sys_status, sys_fecha, persona_natural_id) FROM stdin;
    public       eureka    false    181   �      �           0    0    directores_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('directores_id_seq', 1, false);
            public       eureka    false    180            "
          0    411520    empresas_relacionadas 
   TABLE DATA               h   COPY empresas_relacionadas (id, persona_juridica_id, contratista_id, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    193   �      �           0    0    empresas_relacionadas_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('empresas_relacionadas_id_seq', 1, false);
            public       eureka    false    192            
          0    411452    estatus_contratistas 
   TABLE DATA               f   COPY estatus_contratistas (id, descripcion, informacion_adicional, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    183   �      �           0    0    estatus_contratistas_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('estatus_contratistas_id_seq', 1, false);
            public       eureka    false    182            �           0    0    inpc_id_seq    SEQUENCE SET     3   SELECT pg_catalog.setval('inpc_id_seq', 1, false);
            public       eureka    false    172            i
          0    412264 	   migration 
   TABLE DATA               1   COPY migration (version, apply_time) FROM stdin;
    public       eureka    false    264   �      �           0    0    naturales_juridicas_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('naturales_juridicas_id_seq', 2, true);
            public       eureka    false    188            (
          0    411598    nombres_cajas 
   TABLE DATA               T   COPY nombres_cajas (id, nombre, contratistas_id, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    199   "      �           0    0    nombres_cajas_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('nombres_cajas_id_seq', 1, false);
            public       eureka    false    198            ,
          0    411630    notas_revelatorias 
   TABLE DATA               j   COPY notas_revelatorias (id, nota, contratista_id, usuario_id, estado, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    203   ?      �           0    0    notas_revelatorias_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('notas_revelatorias_id_seq', 1, false);
            public       eureka    false    202            
          0    411429    personas_juridicas 
   TABLE DATA               _   COPY personas_juridicas (id, rif, razon_social, sys_status, sys_fecha, creado_por) FROM stdin;
    public       eureka    false    179   \      �           0    0    personas_juridicas_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('personas_juridicas_id_seq', 2, true);
            public       eureka    false    178            
          0    411412    personas_naturales 
   TABLE DATA               g   COPY personas_naturales (id, nombre, apellido, rif, ci, sys_status, sys_fecha, creado_por) FROM stdin;
    public       eureka    false    177   �      �           0    0    personas_naturales_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('personas_naturales_id_seq', 3, true);
            public       eureka    false    176            &
          0    411560    repr_legales 
   TABLE DATA               ^   COPY repr_legales (id, contratista_id, persona_natural_id, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    197   =      �           0    0    repr_legales_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('repr_legales_id_seq', 1, false);
            public       eureka    false    196            
          0    411396 
   sys_bancos 
   TABLE DATA               U   COPY sys_bancos (id, nombre, rif, codigo_sudeban, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    175   Z      �           0    0    sys_bancos_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('sys_bancos_id_seq', 1, false);
            public       eureka    false    174            *
          0    411614    sys_divisas 
   TABLE DATA               I   COPY sys_divisas (id, nombre, codigo, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    201   w      
          0    411384    sys_inpc 
   TABLE DATA               I   COPY sys_inpc (id, mes, indice, anho, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    173   �      �           0    0    sys_monedas_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('sys_monedas_id_seq', 1, false);
            public       eureka    false    200            
          0    411490    sys_naturales_juridicas 
   TABLE DATA               b   COPY sys_naturales_juridicas (id, rif, juridica, sys_status, sys_fecha, denominacion) FROM stdin;
    public       eureka    false    189   �      Z
          0    412089    sys_tasas_divisas 
   TABLE DATA               T   COPY sys_tasas_divisas (id, sys_divisa_id, tasa, sys_status, sys_fecha) FROM stdin;
    public       eureka    false    249         �           0    0    sys_tasas_divisas_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('sys_tasas_divisas_id_seq', 1, false);
            public       eureka    false    248            k
          0    412271    user 
   TABLE DATA               }   COPY "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at) FROM stdin;
    public       eureka    false    266   6      �           0    0    user_id_seq    SEQUENCE SET     3   SELECT pg_catalog.setval('user_id_seq', 1, false);
            public       eureka    false    265            .	           2606    411803    activos_biologicos_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY activos_biologicos
    ADD CONSTRAINT activos_biologicos_pkey PRIMARY KEY (id);
 U   ALTER TABLE ONLY activos.activos_biologicos DROP CONSTRAINT activos_biologicos_pkey;
       activos         postgres    false    221    221            0	           2606    411819    activos_intangibles_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY activos_intangibles
    ADD CONSTRAINT activos_intangibles_pkey PRIMARY KEY (id);
 W   ALTER TABLE ONLY activos.activos_intangibles DROP CONSTRAINT activos_intangibles_pkey;
       activos         eureka    false    223    223            >	           2606    411920    avaluos_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY avaluos
    ADD CONSTRAINT avaluos_pkey PRIMARY KEY (id);
 ?   ALTER TABLE ONLY activos.avaluos DROP CONSTRAINT avaluos_pkey;
       activos         eureka    false    233    233            #	           2606    411708    bienes_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY bienes
    ADD CONSTRAINT bienes_pkey PRIMARY KEY (id);
 =   ALTER TABLE ONLY activos.bienes DROP CONSTRAINT bienes_pkey;
       activos         eureka    false    211    211            c	           2606    412200    construcciones_inmuebles_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY construcciones_inmuebles
    ADD CONSTRAINT construcciones_inmuebles_pkey PRIMARY KEY (id);
 a   ALTER TABLE ONLY activos.construcciones_inmuebles DROP CONSTRAINT construcciones_inmuebles_pkey;
       activos         eureka    false    259    259            %	           2606    411728    datos_importacion_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY datos_importacion
    ADD CONSTRAINT datos_importacion_pkey PRIMARY KEY (id);
 S   ALTER TABLE ONLY activos.datos_importacion DROP CONSTRAINT datos_importacion_pkey;
       activos         eureka    false    213    213            @	           2606    411945 "   depresiaciones_amortizaciones_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY depresiaciones_amortizaciones
    ADD CONSTRAINT depresiaciones_amortizaciones_pkey PRIMARY KEY (id);
 k   ALTER TABLE ONLY activos.depresiaciones_amortizaciones DROP CONSTRAINT depresiaciones_amortizaciones_pkey;
       activos         eureka    false    235    235            N	           2606    412042    desincorporacion_activos_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY desincorporacion_activos
    ADD CONSTRAINT desincorporacion_activos_pkey PRIMARY KEY (id);
 a   ALTER TABLE ONLY activos.desincorporacion_activos DROP CONSTRAINT desincorporacion_activos_pkey;
       activos         eureka    false    245    245            H	           2606    412012    deterioros_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY deterioros
    ADD CONSTRAINT deterioros_pkey PRIMARY KEY (id);
 E   ALTER TABLE ONLY activos.deterioros DROP CONSTRAINT deterioros_pkey;
       activos         eureka    false    241    241            9	           2606    411882    documentos_registrados_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY documentos_registrados
    ADD CONSTRAINT documentos_registrados_pkey PRIMARY KEY (id);
 ]   ALTER TABLE ONLY activos.documentos_registrados DROP CONSTRAINT documentos_registrados_pkey;
       activos         eureka    false    229    229            e	           2606    412215    fabricaciones_muebles_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY fabricaciones_muebles
    ADD CONSTRAINT fabricaciones_muebles_pkey PRIMARY KEY (id);
 [   ALTER TABLE ONLY activos.fabricaciones_muebles DROP CONSTRAINT fabricaciones_muebles_pkey;
       activos         eureka    false    261    261            4	           2606    411847    facturas_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY facturas
    ADD CONSTRAINT facturas_pkey PRIMARY KEY (id);
 A   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT facturas_pkey;
       activos         eureka    false    227    227            6	           2606    411849 %   facturas_proveedor_id_num_factura_key 
   CONSTRAINT     w   ALTER TABLE ONLY facturas
    ADD CONSTRAINT facturas_proveedor_id_num_factura_key UNIQUE (proveedor_id, num_factura);
 Y   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT facturas_proveedor_id_num_factura_key;
       activos         eureka    false    227    227    227            (	           2606    411751    inmuebles_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY inmuebles
    ADD CONSTRAINT inmuebles_pkey PRIMARY KEY (id);
 C   ALTER TABLE ONLY activos.inmuebles DROP CONSTRAINT inmuebles_pkey;
       activos         eureka    false    215    215            2	           2606    411834    licencia_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY licencia
    ADD CONSTRAINT licencia_pkey PRIMARY KEY (id);
 A   ALTER TABLE ONLY activos.licencia DROP CONSTRAINT licencia_pkey;
       activos         eureka    false    225    225            F	           2606    411976    medicion_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY medicion
    ADD CONSTRAINT medicion_pkey PRIMARY KEY (id);
 A   ALTER TABLE ONLY activos.medicion DROP CONSTRAINT medicion_pkey;
       activos         eureka    false    239    239            Q	           2606    412060    mejoras_propiedad_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY mejoras_propiedades
    ADD CONSTRAINT mejoras_propiedad_pkey PRIMARY KEY (id);
 U   ALTER TABLE ONLY activos.mejoras_propiedades DROP CONSTRAINT mejoras_propiedad_pkey;
       activos         eureka    false    247    247            *	           2606    411769    muebles_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY muebles
    ADD CONSTRAINT muebles_pkey PRIMARY KEY (id);
 ?   ALTER TABLE ONLY activos.muebles DROP CONSTRAINT muebles_pkey;
       activos         eureka    false    217    217            _	           2606    412177    sys_ciudades_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY sys_ciudades
    ADD CONSTRAINT sys_ciudades_pkey PRIMARY KEY (id);
 I   ALTER TABLE ONLY activos.sys_ciudades DROP CONSTRAINT sys_ciudades_pkey;
       activos         eureka    false    257    257            a	           2606    412179 %   sys_ciudades_sys_estado_id_nombre_key 
   CONSTRAINT     w   ALTER TABLE ONLY sys_ciudades
    ADD CONSTRAINT sys_ciudades_sys_estado_id_nombre_key UNIQUE (sys_estado_id, nombre);
 ]   ALTER TABLE ONLY activos.sys_ciudades DROP CONSTRAINT sys_ciudades_sys_estado_id_nombre_key;
       activos         eureka    false    257    257    257            W	           2606    412116    sys_clasificaciones_bien_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY sys_clasificaciones_bienes
    ADD CONSTRAINT sys_clasificaciones_bien_pkey PRIMARY KEY (id);
 c   ALTER TABLE ONLY activos.sys_clasificaciones_bienes DROP CONSTRAINT sys_clasificaciones_bien_pkey;
       activos         eureka    false    251    251            ]	           2606    412159    sys_estados_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY sys_estados
    ADD CONSTRAINT sys_estados_pkey PRIMARY KEY (id);
 G   ALTER TABLE ONLY activos.sys_estados DROP CONSTRAINT sys_estados_pkey;
       activos         eureka    false    255    255            	           2606    411695    sys_formas_org_nombre_key 
   CONSTRAINT     ^   ALTER TABLE ONLY sys_formas_org
    ADD CONSTRAINT sys_formas_org_nombre_key UNIQUE (nombre);
 S   ALTER TABLE ONLY activos.sys_formas_org DROP CONSTRAINT sys_formas_org_nombre_key;
       activos         eureka    false    209    209            !	           2606    411693    sys_formas_org_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY sys_formas_org
    ADD CONSTRAINT sys_formas_org_pkey PRIMARY KEY (id);
 M   ALTER TABLE ONLY activos.sys_formas_org DROP CONSTRAINT sys_formas_org_pkey;
       activos         eureka    false    209    209            <	           2606    411905    sys_gremios_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY sys_gremios
    ADD CONSTRAINT sys_gremios_pkey PRIMARY KEY (id);
 G   ALTER TABLE ONLY activos.sys_gremios DROP CONSTRAINT sys_gremios_pkey;
       activos         eureka    false    231    231            B	           2606    411965    sys_metodo_medicion_nombre_key 
   CONSTRAINT     h   ALTER TABLE ONLY sys_metodo_medicion
    ADD CONSTRAINT sys_metodo_medicion_nombre_key UNIQUE (nombre);
 ]   ALTER TABLE ONLY activos.sys_metodo_medicion DROP CONSTRAINT sys_metodo_medicion_nombre_key;
       activos         eureka    false    237    237            D	           2606    411963    sys_metodo_medicion_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY sys_metodo_medicion
    ADD CONSTRAINT sys_metodo_medicion_pkey PRIMARY KEY (id);
 W   ALTER TABLE ONLY activos.sys_metodo_medicion DROP CONSTRAINT sys_metodo_medicion_pkey;
       activos         eureka    false    237    237            J	           2606    412032    sys_motivios_nombre_key 
   CONSTRAINT     Z   ALTER TABLE ONLY sys_motivios
    ADD CONSTRAINT sys_motivios_nombre_key UNIQUE (nombre);
 O   ALTER TABLE ONLY activos.sys_motivios DROP CONSTRAINT sys_motivios_nombre_key;
       activos         eureka    false    243    243            L	           2606    412030    sys_motivios_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY sys_motivios
    ADD CONSTRAINT sys_motivios_pkey PRIMARY KEY (id);
 I   ALTER TABLE ONLY activos.sys_motivios DROP CONSTRAINT sys_motivios_pkey;
       activos         eureka    false    243    243            Y	           2606    412149    sys_paises_nombre_key 
   CONSTRAINT     V   ALTER TABLE ONLY sys_paises
    ADD CONSTRAINT sys_paises_nombre_key UNIQUE (nombre);
 K   ALTER TABLE ONLY activos.sys_paises DROP CONSTRAINT sys_paises_nombre_key;
       activos         eureka    false    253    253            [	           2606    412147    sys_paises_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY sys_paises
    ADD CONSTRAINT sys_paises_pkey PRIMARY KEY (id);
 E   ALTER TABLE ONLY activos.sys_paises DROP CONSTRAINT sys_paises_pkey;
       activos         eureka    false    253    253            	           2606    411680    sys_tipo_bien_nombre_key 
   CONSTRAINT     _   ALTER TABLE ONLY sys_tipos_bienes
    ADD CONSTRAINT sys_tipo_bien_nombre_key UNIQUE (nombre);
 T   ALTER TABLE ONLY activos.sys_tipos_bienes DROP CONSTRAINT sys_tipo_bien_nombre_key;
       activos         postgres    false    207    207            	           2606    411678    sys_tipo_bien_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY sys_tipos_bienes
    ADD CONSTRAINT sys_tipo_bien_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY activos.sys_tipos_bienes DROP CONSTRAINT sys_tipo_bien_pkey;
       activos         postgres    false    207    207            	           2606    411665    sys_tipo_documento_nombre_key 
   CONSTRAINT     h   ALTER TABLE ONLY sys_tipos_documentos
    ADD CONSTRAINT sys_tipo_documento_nombre_key UNIQUE (nombre);
 ]   ALTER TABLE ONLY activos.sys_tipos_documentos DROP CONSTRAINT sys_tipo_documento_nombre_key;
       activos         eureka    false    205    205            	           2606    411663    sys_tipo_documento_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY sys_tipos_documentos
    ADD CONSTRAINT sys_tipo_documento_pkey PRIMARY KEY (id);
 W   ALTER TABLE ONLY activos.sys_tipos_documentos DROP CONSTRAINT sys_tipo_documento_pkey;
       activos         eureka    false    205    205            g	           2606    412237    sys_tipos_registros_nombre_key 
   CONSTRAINT     h   ALTER TABLE ONLY sys_tipos_registros
    ADD CONSTRAINT sys_tipos_registros_nombre_key UNIQUE (nombre);
 ]   ALTER TABLE ONLY activos.sys_tipos_registros DROP CONSTRAINT sys_tipos_registros_nombre_key;
       activos         eureka    false    263    263            i	           2606    412235    sys_tipos_registros_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY sys_tipos_registros
    ADD CONSTRAINT sys_tipos_registros_pkey PRIMARY KEY (id);
 W   ALTER TABLE ONLY activos.sys_tipos_registros DROP CONSTRAINT sys_tipos_registros_pkey;
       activos         eureka    false    263    263            ,	           2606    411784    vehiculos_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY vehiculos
    ADD CONSTRAINT vehiculos_pkey PRIMARY KEY (id);
 C   ALTER TABLE ONLY activos.vehiculos DROP CONSTRAINT vehiculos_pkey;
       activos         eureka    false    219    219            	           2606    411547    accionistas_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_pkey;
       public         postgres    false    195    195            �           2606    411486 "   bancos_contratistas_num_cuenta_key 
   CONSTRAINT     p   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_num_cuenta_key UNIQUE (num_cuenta);
 `   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT bancos_contratistas_num_cuenta_key;
       public         eureka    false    187    187            �           2606    411484    bancos_contratistas_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT bancos_contratistas_pkey;
       public         eureka    false    187    187            �           2606    411472    clientes_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_pkey;
       public         eureka    false    185    185            	           2606    411507    contratistas_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.contratistas DROP CONSTRAINT contratistas_pkey;
       public         postgres    false    191    191            �           2606    411449    directores_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.directores DROP CONSTRAINT directores_pkey;
       public         eureka    false    181    181            	           2606    411527    empresas_relacionadas_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_pkey;
       public         eureka    false    193    193            �           2606    411461    estatus_contratistas_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY estatus_contratistas
    ADD CONSTRAINT estatus_contratistas_pkey PRIMARY KEY (id);
 X   ALTER TABLE ONLY public.estatus_contratistas DROP CONSTRAINT estatus_contratistas_pkey;
       public         eureka    false    183    183            �           2606    411393    inpc_mes_anho_key 
   CONSTRAINT     S   ALTER TABLE ONLY sys_inpc
    ADD CONSTRAINT inpc_mes_anho_key UNIQUE (mes, anho);
 D   ALTER TABLE ONLY public.sys_inpc DROP CONSTRAINT inpc_mes_anho_key;
       public         eureka    false    173    173    173            �           2606    411391 	   inpc_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY sys_inpc
    ADD CONSTRAINT inpc_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.sys_inpc DROP CONSTRAINT inpc_pkey;
       public         eureka    false    173    173            k	           2606    412268    migration_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);
 B   ALTER TABLE ONLY public.migration DROP CONSTRAINT migration_pkey;
       public         eureka    false    264    264             	           2606    411497    naturales_juridicas_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY sys_naturales_juridicas
    ADD CONSTRAINT naturales_juridicas_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.sys_naturales_juridicas DROP CONSTRAINT naturales_juridicas_pkey;
       public         eureka    false    189    189            	           2606    411499    naturales_juridicas_rif_key 
   CONSTRAINT     f   ALTER TABLE ONLY sys_naturales_juridicas
    ADD CONSTRAINT naturales_juridicas_rif_key UNIQUE (rif);
 ]   ALTER TABLE ONLY public.sys_naturales_juridicas DROP CONSTRAINT naturales_juridicas_rif_key;
       public         eureka    false    189    189            	           2606    411606 (   nombres_cajas_nombre_contratistas_id_key 
   CONSTRAINT     }   ALTER TABLE ONLY nombres_cajas
    ADD CONSTRAINT nombres_cajas_nombre_contratistas_id_key UNIQUE (nombre, contratistas_id);
 `   ALTER TABLE ONLY public.nombres_cajas DROP CONSTRAINT nombres_cajas_nombre_contratistas_id_key;
       public         eureka    false    199    199    199            	           2606    411604    nombres_cajas_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY nombres_cajas
    ADD CONSTRAINT nombres_cajas_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.nombres_cajas DROP CONSTRAINT nombres_cajas_pkey;
       public         eureka    false    199    199            	           2606    411641    notas_revelatorias_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.notas_revelatorias DROP CONSTRAINT notas_revelatorias_pkey;
       public         eureka    false    203    203            �           2606    411436    personas_juridicas_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY personas_juridicas
    ADD CONSTRAINT personas_juridicas_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.personas_juridicas DROP CONSTRAINT personas_juridicas_pkey;
       public         eureka    false    179    179            �           2606    411438    personas_juridicas_rif_key 
   CONSTRAINT     `   ALTER TABLE ONLY personas_juridicas
    ADD CONSTRAINT personas_juridicas_rif_key UNIQUE (rif);
 W   ALTER TABLE ONLY public.personas_juridicas DROP CONSTRAINT personas_juridicas_rif_key;
       public         eureka    false    179    179            �           2606    411424    personas_naturales_ci_key 
   CONSTRAINT     ^   ALTER TABLE ONLY personas_naturales
    ADD CONSTRAINT personas_naturales_ci_key UNIQUE (ci);
 V   ALTER TABLE ONLY public.personas_naturales DROP CONSTRAINT personas_naturales_ci_key;
       public         eureka    false    177    177            �           2606    411422    personas_naturales_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY personas_naturales
    ADD CONSTRAINT personas_naturales_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.personas_naturales DROP CONSTRAINT personas_naturales_pkey;
       public         eureka    false    177    177            �           2606    411426    personas_naturales_rif_key 
   CONSTRAINT     `   ALTER TABLE ONLY personas_naturales
    ADD CONSTRAINT personas_naturales_rif_key UNIQUE (rif);
 W   ALTER TABLE ONLY public.personas_naturales DROP CONSTRAINT personas_naturales_rif_key;
       public         eureka    false    177    177            
	           2606    411567    repr_legales_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY repr_legales
    ADD CONSTRAINT repr_legales_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.repr_legales DROP CONSTRAINT repr_legales_pkey;
       public         eureka    false    197    197            �           2606    411407    sys_bancos_codigo_sudeban_key 
   CONSTRAINT     f   ALTER TABLE ONLY sys_bancos
    ADD CONSTRAINT sys_bancos_codigo_sudeban_key UNIQUE (codigo_sudeban);
 R   ALTER TABLE ONLY public.sys_bancos DROP CONSTRAINT sys_bancos_codigo_sudeban_key;
       public         eureka    false    175    175            �           2606    411403    sys_bancos_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY sys_bancos
    ADD CONSTRAINT sys_bancos_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.sys_bancos DROP CONSTRAINT sys_bancos_pkey;
       public         eureka    false    175    175            �           2606    411405    sys_bancos_rif_key 
   CONSTRAINT     P   ALTER TABLE ONLY sys_bancos
    ADD CONSTRAINT sys_bancos_rif_key UNIQUE (rif);
 G   ALTER TABLE ONLY public.sys_bancos DROP CONSTRAINT sys_bancos_rif_key;
       public         eureka    false    175    175            	           2606    411627    sys_monedas_nombre_key 
   CONSTRAINT     X   ALTER TABLE ONLY sys_divisas
    ADD CONSTRAINT sys_monedas_nombre_key UNIQUE (nombre);
 L   ALTER TABLE ONLY public.sys_divisas DROP CONSTRAINT sys_monedas_nombre_key;
       public         eureka    false    201    201            	           2606    411623    sys_monedas_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY sys_divisas
    ADD CONSTRAINT sys_monedas_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.sys_divisas DROP CONSTRAINT sys_monedas_pkey;
       public         eureka    false    201    201            S	           2606    412096    sys_tasas_divisas_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY sys_tasas_divisas
    ADD CONSTRAINT sys_tasas_divisas_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.sys_tasas_divisas DROP CONSTRAINT sys_tasas_divisas_pkey;
       public         eureka    false    249    249            U	           2606    412103 (   sys_tasas_divisas_sys_divisa_id_tasa_key 
   CONSTRAINT     }   ALTER TABLE ONLY sys_tasas_divisas
    ADD CONSTRAINT sys_tasas_divisas_sys_divisa_id_tasa_key UNIQUE (sys_divisa_id, tasa);
 d   ALTER TABLE ONLY public.sys_tasas_divisas DROP CONSTRAINT sys_tasas_divisas_sys_divisa_id_tasa_key;
       public         eureka    false    249    249    249            m	           2606    412280 	   user_pkey 
   CONSTRAINT     G   ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public         eureka    false    266    266            7	           1259    412226    fki_bienes_facturas    INDEX     D   CREATE INDEX fki_bienes_facturas ON facturas USING btree (bien_id);
 (   DROP INDEX activos.fki_bienes_facturas;
       activos         eureka    false    227            O	           1259    412249    fki_bienes_mejoras    INDEX     N   CREATE INDEX fki_bienes_mejoras ON mejoras_propiedades USING btree (bien_id);
 '   DROP INDEX activos.fki_bienes_mejoras;
       activos         eureka    false    247            	           1259    412125 #   fki_clasificacion_bien_tipos_bienes    INDEX     n   CREATE INDEX fki_clasificacion_bien_tipos_bienes ON sys_tipos_bienes USING btree (sys_clasificacion_bien_id);
 8   DROP INDEX activos.fki_clasificacion_bien_tipos_bienes;
       activos         postgres    false    207            &	           1259    412190    fki_pais_datos_importacion    INDEX     [   CREATE INDEX fki_pais_datos_importacion ON datos_importacion USING btree (pais_origen_id);
 /   DROP INDEX activos.fki_pais_datos_importacion;
       activos         eureka    false    213            :	           1259    412243    fki_tipos_registros_registrados    INDEX     k   CREATE INDEX fki_tipos_registros_registrados ON documentos_registrados USING btree (sys_tipo_registro_id);
 4   DROP INDEX activos.fki_tipos_registros_registrados;
       activos         eureka    false    229            �           1259    411589    fki_bancos_contratistas    INDEX     Z   CREATE INDEX fki_bancos_contratistas ON bancos_contratistas USING btree (contratista_id);
 +   DROP INDEX public.fki_bancos_contratistas;
       public         eureka    false    187            �           1259    411583    fki_contratista_clientes    INDEX     P   CREATE INDEX fki_contratista_clientes ON clientes USING btree (contratista_id);
 ,   DROP INDEX public.fki_contratista_clientes;
       public         eureka    false    185            �           1259    411652    fki_persona_natural    INDEX     Q   CREATE INDEX fki_persona_natural ON directores USING btree (persona_natural_id);
 '   DROP INDEX public.fki_persona_natural;
       public         eureka    false    181            �           1259    411595    fki_sys_bancos_contratistas    INDEX     X   CREATE INDEX fki_sys_bancos_contratistas ON bancos_contratistas USING btree (banco_id);
 /   DROP INDEX public.fki_sys_bancos_contratistas;
       public         eureka    false    187            �           1259    412081    fki_sys_naturales_juridicos    INDEX     X   CREATE INDEX fki_sys_naturales_juridicos ON clientes USING btree (natural_juridico_id);
 /   DROP INDEX public.fki_sys_naturales_juridicos;
       public         eureka    false    185            �	           2606    411804    activos_biologicos_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY activos_biologicos
    ADD CONSTRAINT activos_biologicos_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id);
 ]   ALTER TABLE ONLY activos.activos_biologicos DROP CONSTRAINT activos_biologicos_bien_id_fkey;
       activos       postgres    false    211    2339    221            �	           2606    411820     activos_intangibles_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY activos_intangibles
    ADD CONSTRAINT activos_intangibles_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id);
 _   ALTER TABLE ONLY activos.activos_intangibles DROP CONSTRAINT activos_intangibles_bien_id_fkey;
       activos       eureka    false    211    223    2339            �	           2606    411921    avaluos_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY avaluos
    ADD CONSTRAINT avaluos_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 G   ALTER TABLE ONLY activos.avaluos DROP CONSTRAINT avaluos_bien_id_fkey;
       activos       eureka    false    2339    211    233            �	           2606    411931    avaluos_gremio_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY avaluos
    ADD CONSTRAINT avaluos_gremio_id_fkey FOREIGN KEY (gremio_id) REFERENCES sys_gremios(id) ON UPDATE CASCADE ON DELETE CASCADE;
 I   ALTER TABLE ONLY activos.avaluos DROP CONSTRAINT avaluos_gremio_id_fkey;
       activos       eureka    false    231    233    2364            �	           2606    411926    avaluos_perito_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY avaluos
    ADD CONSTRAINT avaluos_perito_id_fkey FOREIGN KEY (perito_id) REFERENCES public.personas_naturales(id) ON UPDATE CASCADE ON DELETE CASCADE;
 I   ALTER TABLE ONLY activos.avaluos DROP CONSTRAINT avaluos_perito_id_fkey;
       activos       eureka    false    177    2281    233            ~	           2606    411709    bienes_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY bienes
    ADD CONSTRAINT bienes_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES public.contratistas(id);
 L   ALTER TABLE ONLY activos.bienes DROP CONSTRAINT bienes_contratista_id_fkey;
       activos       eureka    false    191    211    2308            	           2606    411714    bienes_principio_contable_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY bienes
    ADD CONSTRAINT bienes_principio_contable_fkey FOREIGN KEY (principio_contable) REFERENCES sys_formas_org(id);
 P   ALTER TABLE ONLY activos.bienes DROP CONSTRAINT bienes_principio_contable_fkey;
       activos       eureka    false    209    2337    211            �	           2606    412201 %   construcciones_inmuebles_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY construcciones_inmuebles
    ADD CONSTRAINT construcciones_inmuebles_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 i   ALTER TABLE ONLY activos.construcciones_inmuebles DROP CONSTRAINT construcciones_inmuebles_bien_id_fkey;
       activos       eureka    false    259    2339    211            �	           2606    411729    datos_importacion_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY datos_importacion
    ADD CONSTRAINT datos_importacion_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 [   ALTER TABLE ONLY activos.datos_importacion DROP CONSTRAINT datos_importacion_bien_id_fkey;
       activos       eureka    false    211    213    2339            �	           2606    411734 $   datos_importacion_sys_moneda_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY datos_importacion
    ADD CONSTRAINT datos_importacion_sys_moneda_id_fkey FOREIGN KEY (sys_moneda_id) REFERENCES public.sys_divisas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 a   ALTER TABLE ONLY activos.datos_importacion DROP CONSTRAINT datos_importacion_sys_moneda_id_fkey;
       activos       eureka    false    2322    201    213            �	           2606    411946 *   depresiaciones_amortizaciones_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY depresiaciones_amortizaciones
    ADD CONSTRAINT depresiaciones_amortizaciones_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 s   ALTER TABLE ONLY activos.depresiaciones_amortizaciones DROP CONSTRAINT depresiaciones_amortizaciones_bien_id_fkey;
       activos       eureka    false    235    211    2339            �	           2606    412043 +   desincorporacion_activos_sys_motivo_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY desincorporacion_activos
    ADD CONSTRAINT desincorporacion_activos_sys_motivo_id_fkey FOREIGN KEY (sys_motivo_id) REFERENCES sys_motivios(id) ON UPDATE CASCADE ON DELETE CASCADE;
 o   ALTER TABLE ONLY activos.desincorporacion_activos DROP CONSTRAINT desincorporacion_activos_sys_motivo_id_fkey;
       activos       eureka    false    245    243    2380            �	           2606    412013    deterioros_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY deterioros
    ADD CONSTRAINT deterioros_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 M   ALTER TABLE ONLY activos.deterioros DROP CONSTRAINT deterioros_bien_id_fkey;
       activos       eureka    false    241    211    2339            �	           2606    411883 *   documentos_registrados_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY documentos_registrados
    ADD CONSTRAINT documentos_registrados_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES public.contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 l   ALTER TABLE ONLY activos.documentos_registrados DROP CONSTRAINT documentos_registrados_contratista_id_fkey;
       activos       eureka    false    229    2308    191            �	           2606    411888 1   documentos_registrados_sys_tipo_documento_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY documentos_registrados
    ADD CONSTRAINT documentos_registrados_sys_tipo_documento_id_fkey FOREIGN KEY (sys_tipo_documento_id) REFERENCES sys_tipos_documentos(id) ON UPDATE CASCADE ON DELETE CASCADE;
 s   ALTER TABLE ONLY activos.documentos_registrados DROP CONSTRAINT documentos_registrados_sys_tipo_documento_id_fkey;
       activos       eureka    false    2328    229    205            �	           2606    412216 "   fabricaciones_muebles_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY fabricaciones_muebles
    ADD CONSTRAINT fabricaciones_muebles_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 c   ALTER TABLE ONLY activos.fabricaciones_muebles DROP CONSTRAINT fabricaciones_muebles_bien_id_fkey;
       activos       eureka    false    2339    261    211            �	           2606    411860    facturas_comprador_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY facturas
    ADD CONSTRAINT facturas_comprador_id_fkey FOREIGN KEY (comprador_id) REFERENCES public.personas_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 N   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT facturas_comprador_id_fkey;
       activos       eureka    false    179    2285    227            �	           2606    411865    facturas_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY facturas
    ADD CONSTRAINT facturas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES public.personas_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 P   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT facturas_contratista_id_fkey;
       activos       eureka    false    227    179    2285            �	           2606    411855    facturas_imprenta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY facturas
    ADD CONSTRAINT facturas_imprenta_id_fkey FOREIGN KEY (imprenta_id) REFERENCES public.personas_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 M   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT facturas_imprenta_id_fkey;
       activos       eureka    false    227    2285    179            �	           2606    411850    facturas_proveedor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY facturas
    ADD CONSTRAINT facturas_proveedor_id_fkey FOREIGN KEY (proveedor_id) REFERENCES public.personas_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 N   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT facturas_proveedor_id_fkey;
       activos       eureka    false    179    227    2285            �	           2606    412221    fk_bienes_facturas    FK CONSTRAINT     �   ALTER TABLE ONLY facturas
    ADD CONSTRAINT fk_bienes_facturas FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 F   ALTER TABLE ONLY activos.facturas DROP CONSTRAINT fk_bienes_facturas;
       activos       eureka    false    211    2339    227            �	           2606    412244    fk_bienes_mejoras    FK CONSTRAINT     �   ALTER TABLE ONLY mejoras_propiedades
    ADD CONSTRAINT fk_bienes_mejoras FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 P   ALTER TABLE ONLY activos.mejoras_propiedades DROP CONSTRAINT fk_bienes_mejoras;
       activos       eureka    false    211    247    2339            }	           2606    412120 "   fk_clasificacion_bien_tipos_bienes    FK CONSTRAINT     �   ALTER TABLE ONLY sys_tipos_bienes
    ADD CONSTRAINT fk_clasificacion_bien_tipos_bienes FOREIGN KEY (sys_clasificacion_bien_id) REFERENCES sys_clasificaciones_bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 ^   ALTER TABLE ONLY activos.sys_tipos_bienes DROP CONSTRAINT fk_clasificacion_bien_tipos_bienes;
       activos       postgres    false    251    207    2391            �	           2606    412185    fk_pais_datos_importacion    FK CONSTRAINT     �   ALTER TABLE ONLY datos_importacion
    ADD CONSTRAINT fk_pais_datos_importacion FOREIGN KEY (pais_origen_id) REFERENCES sys_paises(id) ON UPDATE CASCADE ON DELETE CASCADE;
 V   ALTER TABLE ONLY activos.datos_importacion DROP CONSTRAINT fk_pais_datos_importacion;
       activos       eureka    false    213    2395    253            �	           2606    412238    fk_tipos_registros_registrados    FK CONSTRAINT     �   ALTER TABLE ONLY documentos_registrados
    ADD CONSTRAINT fk_tipos_registros_registrados FOREIGN KEY (sys_tipo_registro_id) REFERENCES sys_tipos_registros(id) ON UPDATE CASCADE ON DELETE CASCADE;
 `   ALTER TABLE ONLY activos.documentos_registrados DROP CONSTRAINT fk_tipos_registros_registrados;
       activos       eureka    false    2409    229    263            �	           2606    411752    inmuebles_bien_id_fkey    FK CONSTRAINT     r   ALTER TABLE ONLY inmuebles
    ADD CONSTRAINT inmuebles_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id);
 K   ALTER TABLE ONLY activos.inmuebles DROP CONSTRAINT inmuebles_bien_id_fkey;
       activos       eureka    false    211    2339    215            �	           2606    411835 $   licencia_activos_intangibles_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY licencia
    ADD CONSTRAINT licencia_activos_intangibles_id_fkey FOREIGN KEY (activo_intangible_id) REFERENCES activos_intangibles(id) ON UPDATE CASCADE ON DELETE CASCADE;
 X   ALTER TABLE ONLY activos.licencia DROP CONSTRAINT licencia_activos_intangibles_id_fkey;
       activos       eureka    false    223    225    2352            �	           2606    411977    medicion_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY medicion
    ADD CONSTRAINT medicion_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 I   ALTER TABLE ONLY activos.medicion DROP CONSTRAINT medicion_bien_id_fkey;
       activos       eureka    false    211    239    2339            �	           2606    411982 $   medicion_sys_metodo_medicion_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY medicion
    ADD CONSTRAINT medicion_sys_metodo_medicion_id_fkey FOREIGN KEY (sys_metodo_medicion_id) REFERENCES sys_metodo_medicion(id) ON UPDATE CASCADE ON DELETE CASCADE;
 X   ALTER TABLE ONLY activos.medicion DROP CONSTRAINT medicion_sys_metodo_medicion_id_fkey;
       activos       eureka    false    237    2372    239            �	           2606    412066 ,   mejoras_propiedad_principio_contable_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY mejoras_propiedades
    ADD CONSTRAINT mejoras_propiedad_principio_contable_id_fkey FOREIGN KEY (principio_contable_id) REFERENCES sys_formas_org(id) ON UPDATE CASCADE ON DELETE CASCADE;
 k   ALTER TABLE ONLY activos.mejoras_propiedades DROP CONSTRAINT mejoras_propiedad_principio_contable_id_fkey;
       activos       eureka    false    2337    247    209            �	           2606    412061 '   mejoras_propiedad_sys_tipo_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY mejoras_propiedades
    ADD CONSTRAINT mejoras_propiedad_sys_tipo_bien_id_fkey FOREIGN KEY (sys_tipo_bien_id) REFERENCES sys_tipos_bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 f   ALTER TABLE ONLY activos.mejoras_propiedades DROP CONSTRAINT mejoras_propiedad_sys_tipo_bien_id_fkey;
       activos       eureka    false    2333    207    247            �	           2606    411770    muebles_bien_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY muebles
    ADD CONSTRAINT muebles_bien_id_fkey FOREIGN KEY (bien_id) REFERENCES bienes(id) ON UPDATE CASCADE ON DELETE CASCADE;
 G   ALTER TABLE ONLY activos.muebles DROP CONSTRAINT muebles_bien_id_fkey;
       activos       eureka    false    2339    211    217            �	           2606    412180    sys_ciudades_sys_estado_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY sys_ciudades
    ADD CONSTRAINT sys_ciudades_sys_estado_id_fkey FOREIGN KEY (sys_estado_id) REFERENCES sys_estados(id) ON UPDATE CASCADE ON DELETE CASCADE;
 W   ALTER TABLE ONLY activos.sys_ciudades DROP CONSTRAINT sys_ciudades_sys_estado_id_fkey;
       activos       eureka    false    2397    255    257            �	           2606    412160    sys_estados_sys_pais_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY sys_estados
    ADD CONSTRAINT sys_estados_sys_pais_id_fkey FOREIGN KEY (sys_pais_id) REFERENCES sys_paises(id);
 S   ALTER TABLE ONLY activos.sys_estados DROP CONSTRAINT sys_estados_sys_pais_id_fkey;
       activos       eureka    false    253    2395    255            �	           2606    411906 $   sys_gremios_persona_juridica_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY sys_gremios
    ADD CONSTRAINT sys_gremios_persona_juridica_id_fkey FOREIGN KEY (persona_juridica_id) REFERENCES public.personas_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 [   ALTER TABLE ONLY activos.sys_gremios DROP CONSTRAINT sys_gremios_persona_juridica_id_fkey;
       activos       eureka    false    179    2285    231            �	           2606    411785    vehiculos_mueble_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY vehiculos
    ADD CONSTRAINT vehiculos_mueble_id_fkey FOREIGN KEY (mueble_id) REFERENCES muebles(id) ON UPDATE CASCADE ON DELETE CASCADE;
 M   ALTER TABLE ONLY activos.vehiculos DROP CONSTRAINT vehiculos_mueble_id_fkey;
       activos       eureka    false    219    2346    217            x	           2606    411553    accionistas_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 U   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_contratista_id_fkey;
       public       postgres    false    195    2308    191            w	           2606    411548 $   accionistas_natural_juridica_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_natural_juridica_id_fkey FOREIGN KEY (natural_juridica_id) REFERENCES sys_naturales_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 Z   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_natural_juridica_id_fkey;
       public       postgres    false    195    2304    189            t	           2606    411513 (   contratistas_estatus_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_estatus_contratista_id_fkey FOREIGN KEY (estatus_contratista_id) REFERENCES estatus_contratistas(id);
 _   ALTER TABLE ONLY public.contratistas DROP CONSTRAINT contratistas_estatus_contratista_id_fkey;
       public       postgres    false    183    2292    191            s	           2606    411508 %   contratistas_natural_juridica_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_natural_juridica_id_fkey FOREIGN KEY (natural_juridica_id) REFERENCES sys_naturales_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 \   ALTER TABLE ONLY public.contratistas DROP CONSTRAINT contratistas_natural_juridica_id_fkey;
       public       postgres    false    191    2304    189            v	           2606    411533 )   empresas_relacionadas_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 i   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_contratista_id_fkey;
       public       eureka    false    2308    193    191            u	           2606    411528 .   empresas_relacionadas_persona_juridica_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_persona_juridica_id_fkey FOREIGN KEY (persona_juridica_id) REFERENCES personas_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 n   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_persona_juridica_id_fkey;
       public       eureka    false    193    179    2285            q	           2606    411584    fk_bancos_contratistas    FK CONSTRAINT     �   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT fk_bancos_contratistas FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 T   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT fk_bancos_contratistas;
       public       eureka    false    191    2308    187            o	           2606    411578    fk_contratista_clientes    FK CONSTRAINT     �   ALTER TABLE ONLY clientes
    ADD CONSTRAINT fk_contratista_clientes FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.clientes DROP CONSTRAINT fk_contratista_clientes;
       public       eureka    false    185    2308    191            n	           2606    411647    fk_persona_natural    FK CONSTRAINT     �   ALTER TABLE ONLY directores
    ADD CONSTRAINT fk_persona_natural FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id) ON UPDATE CASCADE ON DELETE CASCADE;
 G   ALTER TABLE ONLY public.directores DROP CONSTRAINT fk_persona_natural;
       public       eureka    false    181    2281    177            r	           2606    411590    fk_sys_bancos_contratistas    FK CONSTRAINT     �   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT fk_sys_bancos_contratistas FOREIGN KEY (banco_id) REFERENCES sys_bancos(id) ON UPDATE CASCADE ON DELETE CASCADE;
 X   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT fk_sys_bancos_contratistas;
       public       eureka    false    175    187    2275            p	           2606    412076    fk_sys_naturales_juridicos    FK CONSTRAINT     �   ALTER TABLE ONLY clientes
    ADD CONSTRAINT fk_sys_naturales_juridicos FOREIGN KEY (natural_juridico_id) REFERENCES sys_naturales_juridicas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 M   ALTER TABLE ONLY public.clientes DROP CONSTRAINT fk_sys_naturales_juridicos;
       public       eureka    false    185    2304    189            {	           2606    411607 "   nombres_cajas_contratistas_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY nombres_cajas
    ADD CONSTRAINT nombres_cajas_contratistas_id_fkey FOREIGN KEY (contratistas_id) REFERENCES contratistas(id);
 Z   ALTER TABLE ONLY public.nombres_cajas DROP CONSTRAINT nombres_cajas_contratistas_id_fkey;
       public       eureka    false    199    191    2308            |	           2606    411642 &   notas_revelatorias_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 c   ALTER TABLE ONLY public.notas_revelatorias DROP CONSTRAINT notas_revelatorias_contratista_id_fkey;
       public       eureka    false    191    2308    203            z	           2606    411573     repr_legales_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY repr_legales
    ADD CONSTRAINT repr_legales_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 W   ALTER TABLE ONLY public.repr_legales DROP CONSTRAINT repr_legales_contratista_id_fkey;
       public       eureka    false    2308    191    197            y	           2606    411568 $   repr_legales_persona_natural_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY repr_legales
    ADD CONSTRAINT repr_legales_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id) ON UPDATE CASCADE ON DELETE CASCADE;
 [   ALTER TABLE ONLY public.repr_legales DROP CONSTRAINT repr_legales_persona_natural_id_fkey;
       public       eureka    false    197    2281    177            �	           2606    412097 $   sys_tasas_divisas_sys_divisa_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY sys_tasas_divisas
    ADD CONSTRAINT sys_tasas_divisas_sys_divisa_id_fkey FOREIGN KEY (sys_divisa_id) REFERENCES sys_divisas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 `   ALTER TABLE ONLY public.sys_tasas_divisas DROP CONSTRAINT sys_tasas_divisas_sys_divisa_id_fkey;
       public       eureka    false    2322    201    249            >
      x������ � �      @
      x������ � �      J
      x������ � �      4
      x������ � �      d
      x������ � �      6
      x������ � �      L
      x������ � �      V
      x������ � �      R
      x������ � �      F
      x������ � �      f
      x������ � �      D
      x������ � �      8
      x������ � �      B
      x������ � �      P
      x������ � �      X
      x������ � �      :
      x������ � �      b
      x������ � �      \
   =   x�3�,(�OJ�Kɏ7��2��8K8�MuLtL-�L����M@BV�\1z\\\ K�      `
      x������ � �      2
   a   x�5ʻ
�0��9}K��U�;
����֡C|�P�������^@,�%1����RMA�����#�&!�	�K+������gO<vvz��G��      H
   ,   x�3�4�(�OJ�K��,�42�20"=3]+c�=... ��I      N
      x������ � �      T
      x������ � �      ^
      x������ � �      0
   /   x�3�,(�OJ�K��,�42�22�24�36�50�26@Hs��qqq /��      .
      x������ � �      h
      x������ � �      <
      x������ � �      $
      x������ � �      
      x������ � �      
      x������ � �       
      x������ � �      
      x������ � �      "
      x������ � �      
      x������ � �      i
   ;   x��5 �x(��X��ihbdadbbahΕkhl`jdod`hbb���Y�62����� �      (
      x������ � �      ,
      x������ � �      
   B   x�3�46212!Nb�p�[��[������XprA����20"=3Kc��=... ��      
      x�M�;
�0D��]"�#��]�\!U��1,���-%�1�`���<�`���	�۰�u^��2<��ȁ�H��P#{��A�\i|�r���Y��S#W�=U���e�I
���NQ���M8�w���.j      &
      x������ � �      
      x������ � �      *
      x������ � �      
      x������ � �      
   X   x�-��	�0@�s2�X�$P��-�Ԃ
��o����{VO�/��s�d&�B��?d`/\���֠�܎d5��'Ko{J-�5�"~��      Z
      x������ � �      k
      x������ � �     