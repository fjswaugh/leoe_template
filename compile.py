from subprocess import call
import re

def clear(output_directory):
    call(["rm", "-r", output_directory])

def compile_file(filename, variables_lines):
    f = open(filename, 'r')
    file_data = f.read()
    f.close()

    for line in variables_lines:
        key, value = line.split(":")
        key = key.strip()
        value = value.strip()
        file_data = re.sub(r'VARIABLE\[' + key + '\]', value, file_data)

    f = open(filename, 'w')
    f.write(file_data)
    f.close()

def compile(input_directory, output_directory):
    call(["cp", "-rL", input_directory, output_directory])

    variables_file = open(output_directory + "/css/variables.txt", 'r')
    variables_lines = variables_file.readlines()
    variables_file.close()

    compile_file(output_directory + "/css/template.css", variables_lines)
    compile_file(output_directory + "/css/float.css", variables_lines)
    compile_file(output_directory + "/index.php", variables_lines)

call(["mkdir", "-p", "output"])
clear('output/leoe_kimk')
compile('marriageofkimk', 'output/leoe_kimk') 
clear('output/leoe_leoe')
compile('leoeandhyde', 'output/leoe_leoe') 
