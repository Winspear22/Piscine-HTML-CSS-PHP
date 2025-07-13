for i in $(seq -w 0 12); do
  echo "# ex${i}"
  cat "/home/adnen/Desktop/Day05/Day-05-finale/ex${i}/config/routes.yaml"
  echo ""
done > all_routes.txt

