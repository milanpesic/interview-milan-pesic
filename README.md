# interview-milan-pesic

git clone https://github.com/milanpesic/interview-milan-pesic.git

cd www

npm i @vue/cli-service

cd ../

github-compose up --build

docker exec backend php artisan migrate --force
