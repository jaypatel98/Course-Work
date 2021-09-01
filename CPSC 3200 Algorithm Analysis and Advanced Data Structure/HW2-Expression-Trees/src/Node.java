public class Node {
    String operator;
    Node leftChild;
    Node rightChild;

    private boolean isOperator;
    private double value;
    private int size;

    public Node(double d) {
        this.value = d;
        this.isOperator = false;
    }

    public Node(String op, Node leftChild, Node rightChild) {
        this.isOperator = true;
        this.operator = op;
        this.leftChild = leftChild;
        this.rightChild = rightChild;
    }

    public void displayNode() {
        System.out.println("Left Child: " + leftChild + "Right Child: " + rightChild);
    }

    public double evaluateExpr() {
        boolean testVal = isOperator();
        if (isOperator() == false) {
            return getValue();
        } else {
            if (getOperator().equals("+")) {
                return (leftChild.evaluateExpr() + rightChild.evaluateExpr());
            }
            if (getOperator().equals("−")) {
                return (leftChild.evaluateExpr() - rightChild.evaluateExpr());
            }
            if (getOperator().equals("/")) {
                return (leftChild.evaluateExpr() / rightChild.evaluateExpr());
            }
            if (getOperator().equals("*")) {
                return (leftChild.evaluateExpr() * rightChild.evaluateExpr());
            }
        }
        return 0.0;
    }
    public String getExpr() { if (isOperator() == false) {
        String s = String.valueOf(getValue());
        return s;
    } else { if (getOperator().equals("+")) {
        String s = String.valueOf(leftChild.getExpr());
        String s2 = String.valueOf(rightChild.getExpr());
        String giveBack = "(" + s + " + " + s2 + ")";
        return giveBack;
    }
        if (getOperator().equals("−")) {
            String s = String.valueOf(leftChild.getExpr());
            String s2 = String.valueOf(rightChild.getExpr());
            String giveBack = "(" + s + " − " + s2 + ")";
            return giveBack;
        }
        if (getOperator().equals("/")) {
            String s = String.valueOf(leftChild.getExpr());
            String s2 = String.valueOf(rightChild.getExpr());
            String giveBack = "(" + s + " / " + s2 + ")";
            return giveBack;
        }
        if (getOperator().equals("*")) {
            String s = String.valueOf(leftChild.getExpr());
            String s2 = String.valueOf(rightChild.getExpr());
            String giveBack = "(" + s + " * " + s2 + ")";
            return giveBack;
        }
    }
        return "0";
    }
    public Node getLeftChild() {
        return leftChild;
    }
    public Node getRightChild() {
        return rightChild;
    }
    public String getOperator() {
        return operator;
    }
    public double getValue() {
        return value;
    }
    public boolean isOperator() {
        return isOperator;
    }
    public int getLeftHeight() {
        int leftSize = 0; int rightSize;
        if (getLeftChild() == null) { return leftSize = 0;
        } else { int lDepth = getLeftChild().getLeftHeight();
            return (leftSize + 1);
        }
    }
    public int getRightHeight() { int rightSize;
        if (getRightChild() == null) {
            return rightSize = 0;
        } else {
            rightSize = getRightChild().getRightHeight();
            return (rightSize + 1);
        }
    }
}


