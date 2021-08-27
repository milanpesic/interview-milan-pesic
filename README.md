# interview-milan-pesic

git clone https://github.com/milanpesic/interview-milan-pesic.git

github-compose up --build

cd www
npm i @vue/cli-service

cd ../
docker exec backend php artisan migrate
