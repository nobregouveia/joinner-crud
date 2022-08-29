$(document).ready(function() {
    var crudServiceBaseUrl = "http://localhost:8000/api",
        dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudServiceBaseUrl + "/pessoas",
                    method: "get",
                    dataType: "json"
                },
                update: {
                    url: crudServiceBaseUrl + "/pessoas/update",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "put",
                    dataType: "json",
                    complete: function(e) {
                        $("#grid").data("kendoGrid").dataSource.read();
                        if (e.status !== 201 || e.status !== 200) {
                            console.log(e)
                            alert(e.responseJSON.erro[0])
                        }
                    }
                },
                destroy: {
                    url: crudServiceBaseUrl + "/pessoas/destroy",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "delete",
                    dataType: "json"
                },
                create: {
                    url: crudServiceBaseUrl + "/pessoas/store",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "post",
                    dataType: "json",
                    complete: function(e) {
                        if (e.status === 201 || e.status === 200) {
                            setTimeout(function myfunction() {
                                $("#grid").data("kendoGrid").dataSource.read();
                            });
                        } else {
                            alert(e.responseJSON.erro[0])
                        }
                    }

                },
                parameterMap: function(options, operation) {
                    if (operation !== "read" && options.models) {
                        var d = new Date(options.models[0].nascimento_br);
                        options.models[0].nascimento_br = kendo.toString(new Date(d), "yyyy-MM-dd");

                        return {
                            models: kendo.stringify(options.models)
                        };
                    }
                }
            },
            batch: true,
            pageSize: 10,
            schema: {
                model: {
                    id: "id",
                    fields: {
                        id: {
                            editable: false,
                            nullable: false
                        },
                        nome: {
                            validation: {
                                required: true
                            }
                        },
                        nascimento_br: {
                            type: "string",
                            validation: {
                                required: true
                            }
                        },
                        genero: {
                            type: "string",
                            validation: {
                                required: true
                            }
                        },
                        pais: {
                            type: "string",
                            validation: {
                                required: true
                            }
                        }
                    }
                }
            }
        });

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 550,
        toolbar: ["create"],
        columns: [{
                field: "id",
                title: "ID",
                width: "70px"
            },
            {
                field: "nome",
                title: "Nome"
            },
            {
                field: "nascimento_br",
                title: "Data Nascimento",
                format: "{0: dd/MM/yyyy}",
                width: "180px",
                editor: onDatePicker
            },
            {
                field: "genero",
                title: "Gênero",
                width: "120px",
                editor: onDrpGenero
            },
            {
                field: "pais",
                title: "País",
                width: "120px",
                editor: onDrpPaises
            },
            {
                command: ["edit", "destroy"],
                title: "&nbsp;",
                width: "250px"
            }
        ],
        editable: "popup"
    });



    function onDrpGenero(container, options) {
        $('<input required name="Genero" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoComboBox({
                dataTextField: "genero",
                dataValueField: "genero",
                autoBind: true,
                placeholder: "Selecione o seu Gênero...",
                dataSource: [{
                        genero: "Masculino"
                    },
                    {
                        genero: "Feminino"
                    },
                    {
                        genero: "Não Informado"
                    },
                ]
            }).data("kendoComboBox");
    }

    function onDrpPaises(container, options) {
        $('<input required name="País" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoComboBox({
                dataTextField: "pais",
                dataValueField: "pais_id",
                autoBind: true,
                placeholder: "Selecione o seu País...",
                dataSource: {
                    type: "json",
                    transport: {
                        read: {
                            url: crudServiceBaseUrl + "/paises",
                            method: "get",
                            dataType: "json"
                        },
                    }
                }
            }).data("kendoComboBox");
    }

    function onDatePicker(container, options) {
        $('<input type="date" data-date="" data-date-format="dd/MM/yyyy" required="required" name="Nascimento" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDatePicker({
                value: "nascimento_br",
                dateInput: true,
                componentType: "modern",
                autoBind: true,
                weekNumber: true,
                required: true,
                readonly: true,
                format: "dd/MM/yyyy"
            }).data("kendoDatePicker");
    }
});
