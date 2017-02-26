from subprocess import call
import re

def clear(output_directory):
    call(["rm", "-r", output_directory])

def compile(input_directory, output_directory):
    call(["cp", "-rL", input_directory, output_directory])

    variables_file = open(output_directory + "/css/variables.txt", 'r')
    variables_lines = variables_file.readlines()
    variables_file.close()

    css_file = open(output_directory + "/css/template.css", 'r')
    css_data = css_file.read()
    css_file.close()

    for line in variables_lines:
        key, value = line.split(":")
        key = key.strip()
        value = value.strip()
        css_data = re.sub(r'VARIABLE\[' + key + '\]', value, css_data)

    css_file = open(output_directory + "/css/template.css", 'w')
    css_file.write(css_data)
    css_file.close()

call(["mkdir", "-p", "output"])
clear('output/leoe_kimk')
compile('marriageofkimk', 'output/leoe_kimk') 
clear('output/leoe_leoe')
compile('leoeandhyde', 'output/leoe_leoe') 
