import 'dart:html';

var states = [
  'Acre',
  'Alagoas',
  'Amapá',
  'Amazonas',
  'Bahia',
  'Ceará',
  'Distrito Federal',
  'Espírito Santo',
  'Goiás',
  'Maranhão',
  'Mato Grosso',
  'Mato Grosso do Sul',
  'Minas Gerais',
  'Pará',
  'Paraíba',
  'Paraná',
  'Pernambuco',
  'Piauí',
  'Rio de Janeiro',
  'Rio Grande do Norte',
  'Rio Grande do Sul',
  'Rondônia',
  'Roraima',
  'Santa Catarina',
  'São Paulo',
  'Sergipe',
  'Tocantins'
];

void main() {
  var select = SelectElement()
    ..id = 'estado'
    ..name = 'selectEstado'
    ..required = true;

  var defaultOption = OptionElement()
    ..value = ''
    ..text = 'Selecione';
  select.append(defaultOption);

  for (var state in states) {
    var option = OptionElement()
      ..value = state
      ..text = state;
    select.append(option);
  }

  querySelector('#estado')?.replaceWith(select);
}
