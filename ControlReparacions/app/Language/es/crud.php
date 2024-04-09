<?php

/**
 * Language file from ES language. Spanish 
 * 
 * @version 1.2
 * @author JMFXR <dev@siensis.com> 
 * @copyright 2022 SIENSIS Dev
 * @license MIT
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * 
 * This code is provided for educational purposes
 * 
 */

return [
    'datatablesLangURL' => '', // idioma predeterminado: Inglés

    'btnSave'    => 'Guardar',
    'btnRecover'    => 'Recuperar',
    'btnEmpty'    => '<i class="fa-solid fa-triangle-exclamation"></i> Vaciar',
    'btnDelete'    => 'Eliminar',
    'btnUpdate'    => 'Actualizar',
    'btnCancel'    => 'Cancelar',
    'btnGoBack'    => 'Volver a la lista',
    'btnGenerate' => 'Generar',
    'btnShowHide' => 'Mostrar/ocultar',
    
    'colHeadNitem'    => 'N. Ítem',
    'allItems'  => 'Todos los ítems',

    'modalRecoverConfirm' => '¿Deseas recuperar los ítems seleccionados?',
    'modalRemovePermConfirm' => '¿Deseas eliminar permanentemente los ítems seleccionados?',
    'modalRemoveConfirm' => '¿Deseas eliminar los ítems seleccionados?',
    'modalEmptyConfirm' => '<i class=\"fa-solid fa-triangle-exclamation\"></i> ¿Deseas vaciar la papelera?',

    'toolbars' => [
        'btnList'    => '<i class="fa-solid fa-table-list"></i> Lista',
        'btnAdd'    => '<i class="fa-solid fa-file-circle-plus"></i> Agregar',
        'btnRecycled'    => '<i class="fa-solid fa-trash-can"></i> Papelera',
        'btnShowRecycled'    => '<i class="fa-solid fa-trash"></i> Mostrar papelera',
        'btnExport'    => '<i class="fa-solid fa-file-excel"></i> Exportar',
        'btnPrint'    => '<i class="fa-solid fa-print"></i> Imprimir',
        'btnRecover'    => '<i class="fa-solid fa-trash-arrow-up"></i> Recuperar seleccionados',
        'btnRemove'    => '<i class="fa-solid fa-xmark"></i> Eliminar seleccionados',
        'btnRemovePermanently'    => '<i class="fa-solid fa-eraser"></i> Eliminar permanentemente',
        'btnEmpty'    => '<i class="fa-solid fa-recycle"></i> Vaciar papelera',
    ],
    'alerts' => [
        'addOk' => '<i class="fa-solid fa-check"></i> Nuevo ítem agregado correctamente. Se asignó {0, number} como ID',
        'delOk' => '<i class="fa-solid fa-check"></i> Ítem {0, number} eliminado',
        'updatedOk' => '<i class="fa-solid fa-check"></i> Ítem {0, number} actualizado',
        'recoverOk' => '<i class="fa-solid fa-check"></i> Ítems recuperados correctamente',
        'removedOk' => '<i class="fa-solid fa-check"></i> Ítems eliminados correctamente',
        'emptyOk' => '<i class="fa-solid fa-check"></i> La papelera se vació correctamente',
        'addErr' => '<i class="fa-solid fa-triangle-exclamation"></i> Error al agregar el ítem',
        'delErr' => '<i class="fa-solid fa-triangle-exclamation"></i> Error al eliminar el ítem {0, number}',
        'updatedErr' => '<i class="fa-solid fa-triangle-exclamation"></i> Error al actualizar el ítem {0, number}',
        'recoverErr' => '<i class="fa-solid fa-triangle-exclamation"></i> Error al no recuperar ítems',
        'removedErr' => '<i class="fa-solid fa-triangle-exclamation"></i> Error al no eliminar ítems',
        'notExistsErr' => '<i class="fa-solid fa-triangle-exclamation"></i> Error, el ítem {0, number} no existe',
        'callbackCancel'=>'<i class="fa-solid fa-triangle-exclamation"></i> Error en la función de retorno de llamada al cancelar la operación',
    ],
    'titles' => [
        'create' => 'Agregar ítem',
        'delete' => 'Eliminar ítem',
        'edit' => 'Actualizar ítem',
        'view' => 'Ver ítem',
        'trash' => '<i class="fa-solid fa-trash-can"></i> Papelera',
        'modalRecoverConfirm' => 'Confirmar recuperación',
        'modalRemovePermConfirm' => '<span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Eliminar permanentemente</span>',
        'modalRemoveConfirm' => '<span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Eliminar ítem</span>',
        'modalEmptyConfirm' => '<span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Confirmar vaciar papelera</span>',
    ],

    'help' => [
        'btnAdd' => 'Agregar nuevo ítem',
        'btnList' => 'Mostrar lista de ítems',
        'btnRecycled' => 'Mostrar ítems reciclados',
        'btnExport' => 'Exportar datos a archivo de Excel',
        'btnPrint' => 'Imprimir información',

        'btnShowItem' => 'Mostrar ítem',
        'btnEditItem' => 'Editar ítem',
        'btnDelItem' => 'Eliminar ítem',
    ],

    'exceptions' => [
        'tableNull' => 'El nombre de la tabla no puede estar vacío. Por favor, usa setTable para agregar un nombre de tabla básico',
        'tableNoExists' => 'El nombre de la tabla {0} no existe. Por favor, verifica tu base de datos e intenta nuevamente.',
        'idNull' => 'La clave primaria no puede ser nula',
        'fieldNoExists' => "El nombre del campo {0} no existe en la base de datos. Por favor, usa solo campos únicos para campos que existan en la base de datos",
        'fieldTypeUnknown' => "El tipo de campo {0} no existe. Por favor, verifica la documentación de la librería",
    ],
];
