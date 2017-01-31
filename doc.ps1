$Env:DOCKER_TLS_VERIFY = "1"
$Env:DOCKER_HOST = "tcp://192.168.99.100:2376"
$Env:DOCKER_CERT_PATH = "C:\Users\gregoire\.docker\machine\machines\default"
$Env:DOCKER_MACHINE_NAME = "default"
docker stop neo4j
docker rm neo4j
docker run --publish=7474:7474 --publish=7687:7687 --volume=/var/www/neo4j/data:/data --volume=/var/www/neo4j/conf:/conf --env=NEO4J_HEAP_MEMORY=6G --env=NEO4J_CACHE_MEMORY=2G --name=neo4j neo4j